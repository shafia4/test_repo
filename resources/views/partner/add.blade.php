@extends('layouts.app')

@extends('layouts.navbar')

@section('content')



<div class="row">
<div class=col-md-2></div>

 <div class="col-md-8" style="background-color:#F3F3F3; border-radius: 15px;padding:10px">
<h5>Vertragspartner hinzufügen</h5>
<hr>


<form method="POST" action="{{action('PartnerController@store')}}" enctype="multipart/form-data">
	 {{ csrf_field() }}
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" aria-describedby="nameHelp" placeholder="{{__('add.name')}}">
    <small id="nameHelp" class="form-text text-muted">{{__('add.enterpartnername')}}</small>
  </div>
  <div class="form-group">
    <label for="prename">{{__('add.contactperson')}}</label>
    <input type="text" class="form-control" name="contactperson" aria-describedby="prenameHelp" placeholder="{{__('add.entercontactperson')}}">
    <small id="prenameHelp" class="form-text text-muted">{{__('add.entercontactperson1')}}</small>
  </div>
  <div class="form-group">
    <label for="email">{{__('add.email')}}</label>
    <input type="email" class="form-control" name="email" placeholder="email">
    <small id="emailHelp" class="form-text text-muted">{{__('add.enteremail')}}</small>
  </div>
  <div class="form-group">
    <label for="tel">{{__('add.telnr')}}</label>
    <input type="tel" class="form-control" name="tel" placeholder="+43 664 1234567">
     <small  class="form-text text-muted">{{__('add.telnr')}}</small>
  </div>
    <div class="form-group">
    <label for="tel">{{__('add.adress')}}</label>
    <input type="text" class="form-control" name="street" placeholder="High street 27">
     <small class="form-text text-muted">{{__('add.adress')}}</small>
  </div>

   <div class="form-group">
    <label for="tel">{{__('add.city')}}</label>
    <input type="text" class="form-control" name="street" placeholder="01234 New York">
     <small " class="form-text text-muted">{{__('add.city')}}</small>
  </div>

  <div class="form-group">
    <label for="tel">{{__('add.idnr')}}</label>
    <input type="text" class="form-control" name="idnumber" placeholder="{{__('add.idnr')}}">
     <small " class="form-text text-muted">{{__('add.enterid')}}</small>
  </div>

  <div class="form-group">
    <label for="tel">{{__('add.idphoto')}}</label>
    <input type="file" class="form-control"  name="photo">
     <small " class="form-text text-muted">{{__('add.enteridphoto')}}</small>
  </div>




  
 

  <button type="submit" class="btn btn-primary">{{__('add.submit')}}</button>
</form>

</div>


<div class=col-md-2></div>
</div>


@endsection