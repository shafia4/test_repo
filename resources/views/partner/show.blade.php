@extends('layouts.app')
@extends('layouts.navbar')


@section('content')




<div class="container">
	
<div class="row">
    <div class="col-md-6">
        
        	<h3>{{$partner->name}}</h3>

           <small><span class="badge badge-light">
        hinzugefügt {{$partner->created_at->diffForHumans()}}  </span>
          </small>

         <p class="font-weight-bold">
        <span class="badge badge-secondary" style="background-color:lightgreen">letze Bearbeitung {{$partner->updated_at->diffForHumans()}}  </span></p>
          <br>
			

	<table class="table">
		 <tr>
              <th>Kontakt</th>
              <td>{{$partner->contactperson}}</td>
          </tr>

          <tr>
              <th>Tel</th>
              <td>{{$partner->tel}}</td>
          </tr>

		  <tr>
              <th>Email</th>
              <td>{{$partner->email}}</td>
          </tr>

          <tr>
              <th>Street</th>
              <td>{{$partner->street}}</td>
          </tr>

          <tr>
              <th>City</th>
              <td>{{$partner->city}}</td>
          </tr>

          <tr>
              <th>Nummber</th>
              <td>{{$partner->idnumber}}</td>
          </tr>

          @foreach($partner->contract as $partnercontract)

          <tr>
              <th><a href="{{route('asset.show',$partnercontract->asset_id)}}">{{$partnercontract->name}}</a></th>
              <td>{{date('d.M.Y',$partnercontract->termination)}}</td>
          </tr>

          @endforeach

      </table>
  

  </div>

    <div class="col-md-6">

    	

    	 

    	 @foreach($partner->photo as $partnerphoto)

          <a href="{{asset('photos')}}/{{$partnerphoto->path}}" target="_blank" >         
         
          <img src="{{asset('photos')}}/{{$partnerphoto->path}}" style="max-width:150px;" class="img-xs img-thumbnail rounded" alt="Responsive image">
          </a>

          @if($partner->user_id == Auth::user()->id)
          <form action="{{action('PartnerController@deletephoto', $partnerphoto->id)}}" method="POST">
          {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="submit" class="btn btn-primary" value="delete"></button></form>
        @endif

          @endforeach
             
      

          </a>




    	</div>












  





  </div>


 
 @endsection 