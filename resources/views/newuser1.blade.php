@extends('layouts.app')
@extends('layouts.navbar')



@section('content')
<div class="container">


  @guest
  <h1>Welcome to white.App</h1>

  <p>white is a new form of savely storing your personal files</p>

  <h3>this is a landing page</h3>

  @else

  Super, {{Auth::user()->name}}!!

  <div class="alert alert-success" role="alert">

    {{__('add.currencysuc')}} {{Auth::user()->currency->name}} {{__('add.currencysuc1')}}
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














  <div class="progress">
    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
  </div>
  <br>

  <div>
    <div class="container">

      <div class="col-md-8" style="background-color:#F3F3F3; border-radius: 15px;padding:10px">
        <h5 id="exampleModalLabel">

          {{__('home.startadd')}}</h5>



      </div>
      <br>


      <form method="POST" action="{{action('UserController@updatenewuser1')}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
          <input class="form-control" type="text" name="name" maxlength="100">
          <span>{{__('add.entername')}}</span>
        </div>

        <div class="form-group">
          <input class="form-control" type="float" name="value" maxlength="100">
          <span>{{__('add.entervalue')}}</span>
        </div>

        <div class="form-group">
          <label for="exampleFormControlSelect1">{{__('add.usage')}}</label>
          <select name="assetusage_id" class="form-control" id="exampleFormControlSelect1">
            @foreach($assetusage as $usage)
            <option value="{{$usage->id}}">{{$usage->name}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="exampleFormControlSelect1">{{__('add.assettype')}}</label>
          <select name="assettype_id" class="form-control" id="exampleFormControlSelect1">
            @foreach($assettypes as $type)
            <option value="{{$type->id}}">{{@Lang::get($type->name)}}</option>
            @endforeach

          </select>
        </div>


        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

        <input type="submit" class="btn btn-primary">

      </form>

    </div>


  </div>



  @endguest



  @endsection