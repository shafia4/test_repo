@extends('layouts.app')

@extends('layouts.navbar')





@section('content')

@if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
@endif
<div class='container' style='height: 100vh;'>
<table class="table table-hover">

	<thead class="thead-dark">
    <tr>
      <th scope="col">{{__('add.loanname')}}</th>
      <th scope="col">{{__('add.assettype')}}</th>
       <th scope="col">{{__('add.initialloan')}}</th>
      <th scope="col">{{__('add.currentvalue')}}</th>
      <th scope="col">{{__('add.interestloan')}}</th>
      <th scope="col">{{__('add.enddate')}}</th>
     <th scope="col">{{__('add.editdelete')}}</th>

  </tr>
      <thead>
 

	
<tbody>


@foreach($liabilities as $liability)
<tr>
<td>
<a href="{{route('liability.show',$liability->id)}}">{{$liability->name}}</a></td>
<td>
{{Lang::get($liability->liabilitytype)}}</td>
<td>{{number_format($liability->initialvalue,0,0,'.')}}  {{$liability->currency['name']}}  
  


</td>
<td>{{number_format($liability->currentvalue,0,0,'.')}} {{$liability->currency['name']}}  
  @if ($liability->currency['name'] != Auth::user()->currency->name) <br>
   {{number_format($liability->currentvalue*$liability->currency['tolead'] /Auth::user()->currency->tolead,0,0,'.')}}   {{Auth::user()->currency->name}}
   @endif
</td>
<td>{{$liability->interest}}%</td>
<td>@if($liability->enddate=='') n.a. @else {{date('d.m.Y',$liability->enddate)}}@endif</td>

<td><i class="fas fa-trash" type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteliability{{$liability->id}}"></i> * <a href="{{route('liability.edit',$liability->id)}}"><i class="fas fa-edit" type="button" class="btn btn-primary"></i></a></td>

</tr>


<div class="modal fade" id="deleteliability{{$liability->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      {{__('add.liabdelete')}} {{$liability->name}} {{__('add.liabdelete1')}}?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="{{action('LiabilityController@destroy', $liability->id)}}" method="POST">
        	{{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="submit" class="btn btn-primary" value="delete"></button></form>
      </div>
    </div>
  </div>
</div>
</tbody>
</table>

</div>


	@endforeach




@endsection