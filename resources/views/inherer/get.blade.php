@extends('layouts.app')

@extends('layouts.navbar')

@section('content')

<div class="row">
  <div class=col-md-2>.auth</div>

  <div class=col-md-6>
    <form method="GET" action="{{action('InhererController@getdata')}}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="name">{{__('add.inhererget1')}}</label>
        <input type="email" class="form-control" name="inhereremail" aria-describedby="nameHelp" placeholder="">
        <small id="nameHelp" class="form-text text-muted">{{__('add.inhererget2')}}</small>
      </div>
      <div class="form-group">
        <label for="prename">{{__('add.inhererget3')}}</label>
        <input type="text" class="form-control" name="passcode" aria-describedby="prenameHelp" placeholder="{{__('add.inhererget3')}}">
        <small id="prenameHelp" class="form-text text-muted">{{__('add.inhererget4')}}e</small>
      </div>
      <div class="form-group">
        <label for="email">{{__('add.inhererget5')}}</label>
        <input type="email" class="form-control" name="notedemail" placeholder="email">
      </div>

      <button type="submit" class="btn btn-primary">{{__('add.inhererget6')}}</button>
    </form>
  </div>

  <div class=col-md-2></div>
</div>







@endsection