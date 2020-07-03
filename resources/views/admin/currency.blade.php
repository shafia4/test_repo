@extends('layouts.app')

@extends('layouts.navbar')

@section('content')

@if(Auth::user()->role->name ='admin')
<div class="container"> 

	<table class="table">
		<form method="POST" action="{{action('AdminController@currencyupdate')}}" enctype="multipart/form-data">

           {{ csrf_field() }}
           <input type="hidden" name="_method" value="PUT"></input>

		<tr><th scope="col">name</th><th scope="col">value</th> <th scope="col">islead</th></tr>
	@foreach($currency as $curr)
	<tr><td>{{$curr->name}}</td><td><input type="float" name="{{$curr->name}}" placeholder="{{$curr->tolead}}"></input></td><td>{{$curr->leadcurrency}}</td></tr>
	
	
	@endforeach
	 <tr>
              <th>
             <input type="submit"  value="submit"></input></th>
             </tr>
             </form>
	</table>


</div>
@else
forbidden
@endif




@endsection