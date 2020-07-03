@extends('layouts.app')
@extends('layouts.navbar')



@section('content')
<div class="container">


  @guest
  <h1>Welcome to white.App</h1>

  <p>white is a new form of savely storing your personal files</p>

  <h3>this is a landing page</h3>

  @else




  @if(date('H')<5) {{__('home.gn')}} @elseif(date('H')<11) {{__('home.gm')}} @elseif(date('H')<14) {{__('home.gm')}} @elseif(date('H')<18) {{__('home.ga')}} @elseif(date('H')<25) {{__('home.ne')}} @endif {{Auth::user()->name}} <hr>


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







    <ul class="nav nav-tabs pagination" id="newUser" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{__('add.welcome')}}</a>

      </li>
      <li class="nav-item">
        <a class="nav-link" id="currency-tab" data-toggle="tab" href="#currency" role="tab" aria-controls="currency" aria-selected="false">{{__('add.currency')}}</a>


      </li>

    </ul>

    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <br>
        <div class="progress">
          <div class="progress-bar" role="progressbar" style="width: 1%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
        </div>
        <br>

        <h3>{{__('add.newuser1')}}</h3>
        <p>

          <h4>{{__('add.newuser2')}}</h4>
        </p>



        <a class="nav-link" id="currency-tab" data-toggle="tab" href="#currency" role="tab" aria-controls="currency" aria-selected="false">{{__('add.currencystart')}}</a>

      </div>


      <div class="tab-pane fade" id="currency" role="tabpanel" aria-labelledby="profile-tab">
        <div class="progress">
          <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
        </div>

        <form method="POST" action="{{action('UserController@updatenewuser',Auth::user()->id)}}" enctype="multipart/form-data">

          {{ csrf_field() }}
          <input type="hidden" name="_method" value="PUT"></input>
          <table class="table">

            <tr>
              <td>{{__('add.currency')}}</td>
              <td>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">{{__('add.currencystart')}}</label>

                  <select name="currency_id" class="form-control" id="exampleFormControlSelect1">

                    @foreach($currency as $curr)
                    @if(Auth::user()->currency_id==$curr->id)
                    <option selected value="{{$curr->id}}">{{$curr->name}}</option>
                    @else
                    <option value="{{$curr->id}}">{{$curr->name}}</option>
                    @endif
                    @endforeach

                  </select>
                </div>
              </td>

          </table>

          <input type="submit" class="btn btn-primary">





        </form>


      </div>





      @endguest



      @endsection