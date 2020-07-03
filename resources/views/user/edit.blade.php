@extends('layouts.app')

@extends('layouts.navbar')






@section('content')

@if (Auth::user()->id==$id)

<div class="container" style="background-color:white; margin-top:50px">




  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#home" role="tab" aria-controls="pills-home" aria-selected="true">{{__('settings.home')}}</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#profile" role="tab" aria-controls="pills-profile">{{__('settings.settings')}}</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#targets" role="tab" aria-controls="pills-profile">Ziele</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-plan-tab" data-toggle="pill" href="#plan" role="tab" aria-controls="pills-plan">Version</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-inherer-tab" data-toggle="pill" href="#inherer" role="tab" aria-controls="pills-inherer">Erben</a>
    </li>

  </ul>

  <div class="tab-content" id="myTabContent">

    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

      <form method="POST" action="{{action('UserController@update',Auth::user()->id)}}" enctype="multipart/form-data">

        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT"></input>

        <table class="table">
          @if(isset($status)) <h2>{{__('settings.updatesuc')}}</h2>@endif

          <tr>
            <td>{{__('settings.name')}}</td>
            <td><input class="form-control" type="text" name="name" placeholder="{{Auth::user()->name}}"></td>
          </tr>
          <tr>
            <td>{{__('settings.email')}}</td>
            <td><input class="form-control" type="email" name="email" placeholder="{{Auth::user()->email}}"> </td>
          </tr>
          <tr>
            <td>{{__('settings.password')}}</td>
            <td><a href="{{route('changepassword')}}">Passwort Ändern</a></td>
          </tr>
          <tr>
            <td>{{__('settings.street')}}</td>
            <td><input class="form-control" type="text" name="street" placeholder="{{Auth::user()->street}}"></td>
          </tr>
          <tr>
            <td>{{__('settings.city')}}</td>
            <td><input class="form-control" type="text" name="city" placeholder="{{Auth::user()->city}}"> </td>
          </tr>
          <tr>
            <td>{{__('settings.country')}}</td>
            <td><input class="form-control" type="text" name="country" placeholder="{{Auth::user()->country}}"></td>
          </tr>
          <tr>
            <td>{{__('settings.joined')}}</td>
            <td>{{Auth::user()->created_at->diffForHumans()}}</td>
          </tr>


          <tr>
            <td>{{__('settings.account')}}</td>
            <td>{{Auth::user()->role->name}} hier abgrade möglichkeit rein</td>
          </tr>
          <tr>
            <td>{{__('settings.currency')}}</td>
            <td>

              <div class="form-group">
                <label for="exampleFormControlSelect1">{{__('settings.currency')}}</label>

                <select name="currency_id" class="form-control" id="exampleFormControlSelect1">

                  @foreach($currency as $curr)
                  @if($user->currency_id==$curr->id)
                  <option selected value="{{$curr->id}}">{{$curr->name}}</option>
                  @else
                  <option value="{{$curr->id}}">{{$curr->name}}</option>
                  @endif
                  @endforeach



                </select>
              </div>
            </td>

          <tr>
            <td> <input type="submit" class="btn btn-primary" value="{{__('settings.send')}}"></td>
          </tr>






        </table>
    </div>

    </form>


    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">personal

      <table class="table">

        <tr>
          <td> Nachrichten</td>
          <td>
            <ul>
              <li>email</li>
              <li>sms</li>
            </ul>
          </td>
        </tr>
        <tr>
          <td> Grace Period</td>
          <td>
            <ul>
              <li>24 stunden</li>
              <li>48 stunden</li>
            </ul>
          </td>
        </tr>



      </table>

    </div>

    <div class="tab-pane fade" id="targets" role="tabpanel" aria-labelledby="profile-tab">

      <table class="table">

        <tr>
          <td> Target</td>
          <td>
            <ul>
              <li>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Passives Einkommen absolut</label>
                </div>
              </li>
              <li>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Schulden abbauen</label>
                </div>
              </li>
              <li>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Passives Einkommen %</label>
                </div>
              </li>
            </ul>
          </td>
        </tr>



      </table>

    </div>


    <div class="tab-pane fade" id="plan" role="tabpanel" aria-labelledby="plan-tab"> v 0.0.1
    </div>

    <div class="tab-pane fade" id="inherer" role="tabpanel" aria-labelledby="inherer-tab">

      <table class="table table-hover table-striped">


        <thead>
          <tr>

            <th scope="col">{{__('settings.name')}}</th>
            <th scope="col">{{__('settings.isactive')}}</th>
            <th scope="col">{{__('settings.grace')}}</th>

          </tr>
        </thead>

        <tbody>

          @foreach($inherers as $inherer)

          <tr>
            <td>{{$inherer->name}}</td>
            <td>{{$inherer->is_active}}</td>
            <td>{{$inherer->graceperiod/24/60/60}} {{__('settings.day')}} </td>
          </tr>
        </tbody>


        @endforeach
      </table>

    </div>










  </div>
  @else
  h1 forbidden
  @endif


  @endsection