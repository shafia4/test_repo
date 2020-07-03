@extends('layouts.app')

@extends('layouts.navbar')





@section('content')



<div class="container">

  @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
@endif


<div >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
        	Schulden bearbeiten 

           </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
        <form class="form-style-7" method="POST" action="{{action('LiabilityController@update', $liability->id)}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT"></input>
            

            
                <div class="form-group">
                <input class="form-control" type="text" placeholder="{{$liability->name}}" name="name" maxlength="100">
                <span>Gib den Namen ein</span>
                </div>
           

             <div class="form-group">
                
                <input class="form-control" placeholder="{{$liability->currentvalue}}"" type="float" name="currentvalue" maxlength="100">
                <span>Wert</span>
           
              </div>

              <div class="form-group">
                <label for="exampleFormControlSelect1">Währung</label>
                
            <select name="currency_id" class="form-control" id="exampleFormControlSelect1">

             @foreach($currency as $curr)
             @if($liability->currency_id==$curr->id) 
             <option selected value="{{$curr->id}}">{{$curr->name}}</option>
              @else <option value="{{$curr->id}}">{{$curr->name}}</option>
                @endif
             @endforeach


 
                </select>
              </div>
         

        
                <div class="form-group">
                <label for="exampleFormControlSelect1">{{__('add.loankind')}}</label>
                <small>{{$liability->liabilitytype}}</small>
                <select name="liabilitytype" class="form-control" id="exampleFormControlSelect1">

              <option value="loankind.creditcard" > {{Lang::get('loankind.creditcard')}} </option>
              <option value="loankind.privatloan"> {{Lang::get('loankind.privatloan')}}</option>
              <option value="loankind.wageloan"> {{Lang::get('loankind.wageloan')}}</option>
              <option value="loankind.buildingloan"> {{Lang::get('loankind.buildingloan')}}</option>
              <option value="loankind.consumerloan"> {{Lang::get('loankind.consumerloan')}}</option>
              <option value=other> {{Lang::get('loankind.other')}}</option>
 
                </select>
              </div>

              <div class="form-group">
                
                <input class="form-control" placeholder="{{$liability->contractnr}}" type="text" name="contractnr" maxlength="100">
                <span>Kreditvertragsnummer</span>
           
              </div>


              <div class="form-group">
                
                <input class="form-control" placeholder="{{$liability->creditor}}" type="text" name="creditor" maxlength="100">
                <span>Kreditgeber</span>
           
              </div>

              <div class="form-group">
                
                <input class="form-control" type="float" placeholder="{{$liability->initialvalue}}" name="initialvalue" maxlength="100">
                <span>ursprünglicher Kreditbetrag</span>
           
              </div>

                <div class="form-group">
                
                <input class="form-control" type="float" placeholder="{{$liability->interest}}" name="interest" maxlength="100">
                <span>Zinssatz % </span>
           
              </div>

              <div class="form-group">
                
                @foreach($contracts as $contract)
                <a href="{{asset('contracts')}}/{{$contract->path}}"">{{$contract->name}}</a> <i class="fas fa-trash" type="button" class="btn btn-primary" data-toggle="modal" data-target="#deletecontract{{$contract->id}}"></i>
                @endforeach

           
              </div>

               <div class="form-group">
                
                <input class="form-control" type="file"  name="contract" >
                <span>Vertrag Hochladen</span>
           
              </div>



               <div class="form-group">
                
                <input class="form-control" type="date" placeholder="{{$liability->agreementdate}}" name="agreementdate" maxlength="100">
                <span>Abschlussdatum</span>
           
              </div>

               <div class="form-group">
                
                <input class="form-control" type="date" name="enddate" placeholder="{{$liability->enddate}}" maxlength="100">
                <span>Rückzahlungsdatum</span>
           
              </div>

              <div class="form-group">

              	<small>{{$liability->notes}}</small>
                
                <textarea class="form-control" type="date" name="notes" maxlength="100"></textarea>
                <span>Notizen</span>
           
              </div>
         
       

            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">


       
               <input type="submit" class="btn btn-primary">
         
           
           
        </form>
      </div>
      
      
    </div>
  </div>
</div>

@foreach($liability->contract as $liabilitycontract)
<div class="modal fade" id="deletecontract{{$liabilitycontract->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do you really want to delete the  {{$liabilitycontract->name}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="{{action('LiabilityController@deletecontract', $liabilitycontract->id)}}" method="POST">
          {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="submit" class="btn btn-primary" value="delete"></button></form>
      </div>
    </div>
  </div>
</div>
@endforeach



@endsection