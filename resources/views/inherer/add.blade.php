
@extends('layouts.app')

@extends('layouts.navbar')

@section('content')



<div class="row">
<div class="col-md-2"></div>

 <div class="col-md-8" style="background-color:#F3F3F3; border-radius: 15px;padding:10px">

  <h5>{{__('add.addbeneficary')}}</h5>
  <hr>

<form method="POST" action="{{action('InhererController@store')}}" enctype="multipart/form-data">
	 {{ csrf_field() }}
  <div class="form-group">
    <label for="name">{{__('add.name')}}</label>
    <input type="text" class="form-control" name="name" aria-describedby="nameHelp" placeholder="{{__('add.name')}}">
    <small id="nameHelp" class="form-text text-muted">{{__('add.enterbeneficaryname')}}</small>
  </div>
  <div class="form-group">
    <label for="prename">{{__('add.prename')}}</label>
    <input type="text" class="form-control" name="prename" aria-describedby="prenameHelp" placeholder="{{__('add.entername')}}">
    <small id="prenameHelp" class="form-text text-muted">{{__('add.enterprename')}}</small>
  </div>
  <div class="form-group">
    <label for="email">{{__('add.email')}}</label>
    <input type="email" class="form-control" name="email" placeholder="{{__('add.email')}}">
    <small id="graceperiodhelp" class="form-text text-muted">{{__('add.emailadressvalidation')}}</small>
  </div>
  <div class="form-group">
    <label for="tel">{{__('add.telnr')}}</label>
    <input type="tel" class="form-control" name="telnr" placeholder="+43 664 1234567">
     <small id="graceperiodhelp" class="form-text text-muted">{{__('add.telnr')}}</small>
  </div>



  <div class="form-group">
    <label for="graceperiod">{{__('add.choosegrace')}}</label>
    <select class="form-control" name="graceperiod">
      <option value="0">{{__('add.always')}}</option>
      <option value="86400">{{__('add.24h')}}</option>
      <option value="259200">{{__('add.3d')}}</option>
      <option value="604800">{{__('add.7d')}}</option>
      <option value="1209600">{{__('add.14d')}}</option>
      <option value="5184000">{{__('add.60d')}}</option>
    </select>
    <small id="graceperiodhelp" class="form-text text-muted">{{__('add.graceexplain')}}</small>
  </div>
  <div class="form-check">
    <textarea rows="4" cols="50" class="form-control" name="message" placeholder="Add a personal message" id="active"> 
    </textarea>
     <small id="graceperiodhelp" class="form-text text-muted">{{__('add.addmessage')}}</small>

  </div>

  <div class="form-check">
    <input type="checkbox" class="form-check-input" name="is_active" value="1">
    <label class="form-check-label" for="active">{{__('add.makeactive')}}</label>
  </div>

  <button type="submit" class="btn btn-primary">{{__('add.submit')}}</button>
</form>
</div>

<div class=col-md-2></div>
</div>


@endsection