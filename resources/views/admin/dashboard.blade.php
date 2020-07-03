@extends('layouts.app')

@extends('layouts.navbar')

@section('content')

@if(Auth::user()->role->name ='admin')
<div class="container"> 

	

	<div class="card">
  <div class="card-header">
    Overview
  </div>
  <div class="card-body">
   	<div class="row">
   		<div class="col-md-4"> <h5 class="card-title">User</h5> <p>{{$user->count()}}</p></div>
   		<div class="col-md-4"> <h5 class="card-title">last User joined</h5> <p>{{$lastuserjoin->name}} <small>{{$lastuserjoin->created_at->diffForHumans()}}</small></p></div>
   		<div class="col-md-4"> <h5 class="card-title">last User updated</h5><p>{{$lastuserupdate->name}} <small>{{$lastuserupdate->updated_at->diffForHumans()}} </small></p></div>
    
  
    </div>
  </div>
</div>
  <div class="card">
  <div class="card-header">
    Overview
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-4"> <h5 class="card-title">users free</h5> <p>{{$user->count()}}</p></div>
      <div class="col-md-4"> <h5 class="card-title">Turnover</h5> <p>{{$lastuserjoin->name}} <small>{{$lastuserjoin->created_at->diffForHumans()}}</small></p></div>
      <div class="col-md-4"> <h5 class="card-title">last User updated</h5><p>{{$lastuserupdate->name}} <small>{{$lastuserupdate->updated_at->diffForHumans()}} </small></p></div>
    
  
    </div>
  </div>
</div>

	{{$user->count()}}

	{{$lastuserjoin}} {{$lastuserjoin->created_at->diffForHumans()}}

	{{$lastuserupdate}} {{$lastuserupdate->updated_at->diffForHumans()}}

	<li>zahlende user</li>
	<li>freie</li>
	<li>umsatz</li>




</div>
@else
forbidden
@endif




@endsection