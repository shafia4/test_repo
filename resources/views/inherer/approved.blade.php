
@extends('layouts.app')

@extends('layouts.navbar')

@section('content')



<h4> {{__('add.welcomeauth')}}  {{$inhererid->name}} </h4>




@if(strToTime(now())<($acessedtime)+$inhererid->graceperiod and $inhererid->is_active==1)



{{__('add.sucauth')}} {{date('d.m.Y h:i:sa',($acessedtime))}}.


{{$userid->name}} {{__('add.sucauth1')}} {{$userid->name}} {{__('add.sucauth2')}}
{{date('d.m.Y h:i:sa',($acessedtime)+$inhererid->graceperiod)}}

{{$acessedtime}}
{{$inhererid->graceperiod}}
{{date('m.w.d',(strToTime(now())-($acessedtime)+$inhererid->graceperiod))}}



@elseif((strToTime(now())>($acessedtime)+$inhererid->graceperiod) and $inhererid->is_active==1))



<h3>{{$userid->name}}</h3>

<div>
 <ul class="nav nav-pills nav-fill" id="inherercontent">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" role="tab" aria-controls="overview" href="#overview">Overview</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" role="tab" aria-controls="assets" href="#assets">{{__('add.authassets')}}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#liabilities" data-toggle="tab" role="tab" aria-controls="liabilities">{{__('add.authliab')}}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#partners" tabindex="-1" data-toggle="tab" role="tab" aria-controls="partners">{{__('add.authpartner')}}</a>
  </li>
</ul>
</div>
<br>

<div class="tab-content" id="myInhererContent">
  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
    <br>
  <h4> <p>{{$userid->name}} {{__('add.sucauth3')}} </p></h4>
   {{__('add.sucauth4')}} {{date('d.m.y',($acessedtime)+$inhererid->graceperiod)}}</div>
  <div class="tab-pane fade" id="assets" role="tabpanel" aria-labelledby="assets-tab">

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


  </tr>
      <thead>
 

	
<tbody>





@foreach($inherer->asset as $allasset)

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
 @if($allasset->currency_id==$inherer->currency_id)

  {{number_format($allasset->value,0,0,'.')}} {{$inherer->currency->name}}
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

  <a href="{{route('liability.show',$allasset->liability['id'])}}">{{$allasset->liability['name']}}</a>

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


@endforeach

<td> </td>
<td> </td>
<td> </td>
<td>
	
	


  
	
</td>
<td> </td>
<td>
	
</td>



</tr>
</tbody>

</table>


</div>







  <div class="tab-pane fade" id="liabilities" role="tabpanel" aria-labelledby="liabilities-tab">
    
<table class="table table-hover">

  <thead class="thead-dark">
    <tr>
      <th scope="col">{{__('add.loanname')}}</th>
      <th scope="col">{{__('add.assettype')}}</th>
       <th scope="col">{{__('add.initialloan')}}</th>
      <th scope="col">{{__('add.currentvalue')}}</th>
      <th scope="col">{{__('add.interestloan')}}</th>
      <th scope="col">{{__('add.enddate')}}</th>
    

  </tr>
      <thead>
 

  
<tbody>


@foreach($inherer->liability as $liability)
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


</tr>


<div class="modal fade" id="deleteliability{{$liability->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
</tbody>
</table>

@endforeach



  </div>
  <div class="tab-pane fade" id="partners" role="tabpanel" aria-labelledby="partners-tab">
    




    <table class="table table-hover table-striped">
  <thead>
    <tr>
      
      <th scope="col">{{__('add.name')}}</th>
      <th scope="col">{{__('add.contactperson')}}</th>
      <th scope="col">{{__('add.email')}}</th>
      <th scope="col">{{__('add.telnr')}}</th>
      <th scope="col">{{__('add.adress')}}</th>
      <th scope="col">{{__('add.city')}}</th>
      <th scope="col">{{__('add.contracts')}}</th>

    </tr>
  </thead>

    <tbody>

  @foreach($partners as $partner)



    <tr>
      <th scope="row"> <a href="{{route('partner.show',$partner->id)}}">
      {{$partner->name}} 

       @if(isset($partner->photo))

       @foreach($partner->photo as $partnerphoto)

                 
          <img src="{{asset('photos')}}/{{$partnerphoto->path}}" style="max-width:150px;" class="img-xs img-thumbnail rounded" alt="Responsive image">
          @endforeach
             
          @endif

          </a>

      </th>
      <th >{{$partner->contactperson}}</th>
      <td>{{$partner->email}}</td>
      <td>{{$partner->tel}}</td>
      <td>{{$partner->street}}</td>
      <td>{{$partner->city}}</td>
      <td><ul> @foreach($partner->contract as $partnercontract)
       
       <a href="{{route('asset.show',$partnercontract->asset['id'])}}">
        <small><span class="badge badge-light">
{{$partnercontract->asset['name']}}  {{$partnercontract->name}} </span>
  </small>
</a>
@endforeach
</ul>
</td>
      
     
    </tr>





@endforeach
  </tbody>
</table>






  </div>
</div>




@else
{{$userid->name}} {{__('add.nosucauth')}}

@endif




@endsection