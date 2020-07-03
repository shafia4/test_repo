@extends('layouts.app')
@extends('layouts.navbar')



@section('content')
<div class="container">


  @guest
  <h1>Welcome to white.App</h1>

  <p>white is a new form of savely storing your personal files</p>

  <h3>this is a landing page</h3>

  @else

  super, {{Auth::user()->name}}!!

  <div class="alert alert-success" role="alert">

    {{__('add.addassetsuc')}} {{$asset->name}} {{__('add.addassetsuc1')}} {{$asset->value}} {{Auth::user()->currency->name}} {{__('add.addassetsuc2')}}
  </div>


  <hr>


  @if (session('status'))
  <div class="alert alert-success">
    {{ session('message') }}
  </div>
  @endif




  @if(count($errors)>0)

  <div class="alert alert-danger">

    <ul>

      @foreach ($errors->all() as $error)

      <li>{{$error}}</li>


      @endforeach

    </ul>

  </div>

  @endif





  <div class="container">




    <div class="progress">
      <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
    </div>
    <br>

    <div class="col-md-8" style="background-color:#F3F3F3; border-radius: 15px;padding:10px">



      <h5>
        {{__('add.addliab')}}
        <p> <a href="{{route('user.new3')}}">{{__('add.addliab1')}}</a></p>

      </h5>
      <hr>
      <form method="POST" action="{{action('UserController@updatenewuser2')}}">
        {{ csrf_field() }}


        <div class="form-group">
          <input class="form-control" type="text" name="name" maxlength="100">
          <span>{{__('add.entername')}}</span>
        </div>


        <div class="form-group">

          <input class="form-control" type="float" name="currentvalue" maxlength="100">
          <span>{{__('add.value')}}</span>

        </div>

        <div class="form-group">
          <label for="exampleFormControlSelect1">{{__('add.currency')}}</label>
          <select name="currency_id" class="form-control" id="exampleFormControlSelect1">

            @foreach($currency as $curr)
            <option selected value="{{$curr->id}}">{{$curr->name}}</option>
            @endforeach



          </select>
        </div>



        <div class="form-group">
          <label for="exampleFormControlSelect1">{{__('add.loankind')}}</label>
          <select name="liabilitytype" class="form-control" id="exampleFormControlSelect1">

            <option value="loankind.creditcard"> {{Lang::get('loankind.creditcard')}} </option>
            <option value="loankind.privatloan"> {{Lang::get('loankind.privatloan')}}</option>
            <option value="loankind.wageloan"> {{Lang::get('loankind.wageloan')}}</option>
            <option value="loankind.buildingloan"> {{Lang::get('loankind.buildingloan')}}</option>
            <option value="loankind.consumerloan"> {{Lang::get('loankind.consumerloan')}}</option>
            <option value=other> {{Lang::get('loankind.other')}}</option>

          </select>
        </div>

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
          <span>{{__('add.interest')}} </span>

        </div>



        <div class="form-group">

          <input class="form-control" type="date" name="agreementdate" maxlength="100">
          <span>{{__('add.agreedon')}}</span>

        </div>

        <div class="form-group">

          <input class="form-control" type="date" name="enddate" maxlength="100">
          <span>{{__('add.repaymenton')}}</span>

        </div>



        <div class="form-group">

          <textarea class="form-control" type="date" name="notes" maxlength="100"></textarea>
          <span>{{__('add.notes')}}</span>

        </div>



        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">


        <input type="submit" class="btn btn-primary">



      </form>
    </div>




  </div>

  <div class="tab-pane fade" id="member" role="tabpanel" aria-labelledby="member-tab">


    @if(isset($status)) <h2>{{__('add.addassetsuc2')}}/h2>@endif



  </div>

  @endguest



  @endsection