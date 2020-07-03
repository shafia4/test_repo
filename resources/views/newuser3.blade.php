@extends('layouts.app')
@extends('layouts.navbar')



@section('content')
<div class="container">


  @guest
  <h1>Welcome to white.App</h1>

  <p>white is a new form of savely storing your personal files</p>

  <h3>this is a landing page</h3>

  @else



  <div class="card" style="width: 33rem;">

    <div class="card-body">
      <h5 class="card-title">{{__('add.newusersuc1')}} {{Auth::user()->name}} </h5>
      <p class="card-text">{{__('add.newusersuc2')}} {{Auth::user()->asset->count()}} {{__('add.newusersuc3')}} {{Auth::user()->liability->count()}} {{__('add.newusersuc4')}}</p>
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item"><a href="{{route('asset.create')}}">{{__('add.newusersuc5')}}</a></li>
      <li class="list-group-item"><a href="{{route('liability.create')}}">{{__('add.newusersuc6')}}</a></li>
      <li class="list-group-item"><a href="{{route('inherer.add')}}">{{__('add.newusersuc7')}}</a></li>
      <li class="list-group-item"><a href="{{route('partner.add')}}">{{__('add.newusersuc8')}}</a></li>

    </ul>

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






  <div class="tab-pane fade" id="member" role="tabpanel" aria-labelledby="member-tab">


    @if(isset($status)) <h2>erfolgeich upgedated</h2>@endif

    <tr>
      <td>Account</td>
      <td>{{Auth::user()->role->name}} Du hast einen Gratis Account!</td>
    </tr>

  </div>
</div>






























@endguest

@endsection