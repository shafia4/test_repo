@extends('layouts.app')

@extends('layouts.navbar')





@section('content')

<div class="container">

  <div class="row">

   <div class="col-md-2"></div>

   <div class="col-md-8" style="background-color:#F3F3F3; border-radius: 15px;padding:10px">



        <h5 >
        	{{__('add.liabilityadd')}}

           </h5>
           <hr>
       
    
     
        <form class="form-style-7" method="POST" action="{{action('LiabilityController@store')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            

            
                <div class="form-group">
                <input class="form-control" type="text" name="name" maxlength="100">
                <span>{{__('add.entername')}}</span>
                </div>
           

             <div class="form-group">
                
                <input class="form-control" type="float" name="currentvalue" maxlength="100">
                <span>{{__('add.currentvalue')}}</span>
           
              </div>
              <hr>

               <div class="form-group">
                <label for="exampleFormControlSelect1">{{__('add.currency')}}</label>
                <select name="currency_id" class="form-control" id="exampleFormControlSelect1">

             @foreach($currency as $curr)
              @if($curr->name==Auth::user()->currency->name)<option value="{{$curr->id}}" selected >{{$curr->name}}</option> @endif
              <option value="{{$curr->id}}">{{$curr->name}}</option> 
             @endforeach


 
                </select>
              </div>
              <hr>
         

        
                <div class="form-group">
                <label for="exampleFormControlSelect1">{{__('add.usage')}}</label>
                <select name="liabilitytype" class="form-control" id="exampleFormControlSelect1">

              <option value="loankind.creditcard"> {{Lang::get('loankind.creditcard')}} </option>
              <option value="loankind.privatloan"> {{Lang::get('loankind.privatloan')}}</option>
              <option value="loankind.wageloan"> {{Lang::get('loankind.wageloan')}}</option>
              <option value="loankind.buildingloan"> {{Lang::get('loankind.buildingloan')}}</option>
              <option value="loankind.consumerloan"> {{Lang::get('loankind.consumerloan')}}</option>
              <option value=other> {{Lang::get('loankind.other')}}</option>
 
                </select>
              </div>
              <hr>

              <div class="form-group">
                
                <input class="form-control" type="text" name="contractnr" maxlength="100">
                <span>{{__('add.loancontractnr')}}</span>
           
              </div>


              <div class="form-group">
                
                <input class="form-control" type="text" name="creditor" maxlength="100">
                <span>{{__('add.lender')}}</span>
           
              </div>

              <div>
              
              </div>

              <div class="form-group">
                
                <input class="form-control" type="number" name="initialvalue" maxlength="100">
                <span>{{__('add.initialloan')}}</span>
           
              </div>

                <div class="form-group">
                
                <input class="form-control" type="float" name="interest" maxlength="100">
                <span>{{__('add.interestloan')}}</span>
           
              </div>



               <div class="form-group">
                
                <input class="form-control" type="date" name="agreementdate" maxlength="100">
                <span>{{__('add.asgreedon')}}</span>
           
              </div>

               <div class="form-group">
                
                <input class="form-control" type="date" name="enddate" maxlength="100">
                <span>{{__('add.repaymenton')}}</span>
           
              </div>

                <div class="form-group">
                
                <input class="form-control" type="file"  name="contract" >
                <span>{{__('add.uploadcontract')}}</span>
           
              </div>

              <div class="form-group">
                
                <textarea class="form-control" type="date" name="notes" maxlength="100"></textarea>
                <span>{{__('add.notes')}}</span>
           
              </div>
         
       

            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">


       
               <input type="submit" class="btn btn-primary">
         
           
           
        </form>
      </div>
      
<div class="col-md-2"></div>
</div>
</div>



@endsection