@extends('layouts.app')
@extends('layouts.navbar')

@section('content')

@if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
@endif

<table class="table table-hover" class="indextable" >

    <thead class="thead-dark">
    <tr>
      <th scope="col">{{__('add.asset')}}</th>
      <th scope="col">{{__('add.assettype')}}</th>
      <th scope="col">{{__('add.usage')}}</th>
      <th scope="col">{{__('add.value')}}</th>
      <th scope="col">{{__('add.value')}} {{Auth::user()->currency->name}}</th>
      <th scope="col">{{__('add.partner')}} / linked liability</th>
     <th scope="col">{{__('add.interest')}}</th>
      <th scope="col">{{__('add.lastedit')}}</th>
     <th scope="col">{{__('add.editdelete')}}</th>

  </tr>
      <thead>
 

    
<tbody>





@foreach($allassets as $allasset)

<tr>

<td><a href="{{route('asset.show',$allasset->id)}}">
{{$allasset->name}}</a></td>
<td>
{{Lang::get($allasset->assettype->name)}}</td>
<td>
{{$allasset->assetusage->name}}</td>
<td>
{{number_format($allasset->value,0,0,'.')}} {{$allasset->currency['name']}}
</td>

<td>
  @if(isset($allasset->value))
 @if($allasset->currency_id==Auth::user()->currency_id)

  {{number_format($allasset->value,0,0,'.')}} {{Auth::user()->currency->name}}
  @else 
  {{number_format($allasset->value*$allasset->currency->tolead/Auth::user()->currency->tolead,0,0,'.')}}{{Auth::user()->currency->name}}
  @endif
   @endif
</td>


<td>
  @if (isset($allasset->contract))
  @foreach($allasset->contract as $allassetcontract)
  @foreach($allassetcontract->partner as $allassetcontractpartner)
  <a href="{{route('partner.show',$allassetcontractpartner->id)}}">{{$allassetcontractpartner->name}} </a>
 @endforeach
 @endforeach  
  
  @endif
  @if(!empty($allasset->liability_id))
	<a href="{{route('liability.show',$allasset->liability_id)}}">{{$allasset->liability_id}}</a>
  @endif
</td>

<td>
    @if (isset($allasset->interest))
    {{$allasset->interest}} %
    @else
    {{$allasset->value == 0 ? 0 : number_format(($allasset->revenue-$allasset->costs)/$allasset->value,3)*100}} %
    @endif

</td>

<td>
  <small><span class="badge badge-light">
 
  {{$allasset->updated_at->diffForHumans()}} 

  </span>
  </small>
  

</td>


<td> <i class="fas fa-trash" type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete{{$allasset->id}}"></i> * <a href="{{route('asset.edit',$allasset->id)}}"><i class="fas fa-edit" type="button" class="btn btn-primary"></i></a> </td></td>
</tr>
@endforeach

<tr><td>Total</td>
<td> </td>
<td> </td>
<td> </td>
<td>
    
    {{number_format($totalvalue,0,0,'.')}}{{Auth::user()->currency->name}}

  {{$totalvalue}}
  
    
</td>
<td> </td>
<td>
    <?php $r=0 ; $c=0?>
    @foreach($allassets as $allasset) 
    
    <?php $c = $c+$allasset->cost; $r = $r+$allasset->revenue ?>
    @endforeach
    {{$totalvalue == 0 ? 0 : number_format(($r+$c)/($totalvalue),3,0,'.')*100}}%
</td>



</tr>
</tbody>

</table>

@foreach($allassets as $allasset)

<div class="modal fade" id="delete{{$allasset->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{__('add.deleteasset')}} {{$allasset->name}} -  {{$allasset->value}} {{__('add.deleteasset1')}}?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="{{action('AssetController@destroy', $allasset->id)}}" method="POST">
            {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="submit" class="btn btn-primary" value="delete"></button></form>
      </div>
    </div>
  </div>
</div>
@endforeach







@endsection
