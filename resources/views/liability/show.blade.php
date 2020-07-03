@extends('layouts.app')

@extends('layouts.navbar')





@section('content')


<div class="container" >



       
        	<h1>{{$liability->name}}</h1>
          
          @if(isset($updated))
          {{$updated}}
          @endif
       <small> {{__('add.added')}} {{$liability->created_at->diffForHumans()}}  </span>
  </small>

 <p class="font-weight-bold">
<span class="badge badge-secondary" style="background-color:lightgreen">{{__('add.lastedit')}} {{$liability->updated_at->diffForHumans()}}  </span></p>
  <br>
    @if($liability->user->id == Auth::user()->id)
<p><a href="{{route('liability.edit',$liability->id)}}"> {{__('add.edit')}} </a></p>
@endif
<hr>
        <br>
                  <div class="progress">
  <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{(($liability->initialvalue-$liability->currentvalue)/$liability->initialvalue)*100}}% " aria-valuenow="{{$liability->currentvalue}}" aria-valuemin="0" aria-valuemax="{{$liability->initialvalue}}">{{(($liability->initialvalue-$liability->currentvalue)/$liability->initialvalue)*100}} {{__('add.paidback')}}</div>
</div>
<br>
   
    <div class="col-md-12" style="border-style:solid; border-width:1px; border-radius: 15px">

      	<table class="table"> 
      		<tr><td>{{__('add.currentvalue')}} {{$liability->currency->name}}</td><td>         {{number_format($liability->currentvalue,0,0,'.')}} </td></tr>

          @if ($liability->currency->name != Auth::user()->currency->name)
          <tr><td>{{__('add.currentvalue')}} {{Auth::user()->currency->name}}</td><td>         {{number_format($liability->currentvalue*$liability->currency->tolead/Auth::user()->currency->tolead,0,0,'.')}} </td></tr>

          @endif
      		<tr><td>{{__('add.lender')}}</td><td>        {{$liability->creditor}} </td></tr>
      		<tr><td>{{__('add.initialloan')}}</td><td>         {{$liability->initialvalue}} <small> --> paid back:{{number_format(($liability->initialvalue-$liability->currentvalue)/$liability->initialvalue ,2,'.',',')*100}} % </small></td></tr>
      		<tr><td>{{__('add.loankind')}}</td><td>        {{Lang::get($liability->liabilitytype)}} </td></tr>
      		<tr><td>{{__('add.interestloan')}}</td><td>        {{$liability->interest}}% </td></tr>
      		<tr><td>{{__('add.loancontractnr')}}</td><td>        {{$liability->contractnr}} </td></tr>
      		<tr><td>{{__('add.agreedon')}}</td><td> @if ($liability->agreementdate=='') n.a. @else {{date('d.m.Y' ,$liability->agreementdate)}}   </td></tr>@endif  
      		<tr><td>{{__('add.enddate')}}</td><td>    @if ($liability->enddate=='') n.a. @else   {{date('d.m.Y',$liability->enddate)}} @endif</td></tr>
      		<tr><td>{{__('add.notes')}}</td><td>        {{$liability->notes}} </td></tr>
          <tr><td>{{__('add.contracts')}}</td><td>       @foreach($liability->contract as $liabilitycontract) <a href="{{asset('contracts')}}/{{$liabilitycontract->path}}" target="blank">{{$liabilitycontract->name}} </a> @endforeach</td></tr>
      		



      	</table>
     
 
           

     
                
          
      </div>
      
      
    </div>
  </div>
</div>
</div

@endsection