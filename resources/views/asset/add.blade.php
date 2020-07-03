@extends('layouts.app')

@extends('layouts.navbar')


@section('content')
<script type="text/javascript"> var assetype = 0; </script>
<div class="container">              
	@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
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
	<!--                    
	@foreach($assettypes as $assettype)
		<div class="card" style="width: 18rem;" >
		<div class="card-body"> <a href="" data-toggle="modal"  data-target="#addimmo" type="select" onclick="assettype={{$assettype->name}}">{{$assettype->name}} </a>  </div> </div>
		</input>
	@endforeach -->
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8" style="background-color:#F3F3F3; border-radius: 15px;padding:10px">
			<h5 id="exampleModalLabel">
            {{__('add.addasset')}} </h5>
		<div>
        <form class="form-style-7" method="POST" action="{{action('AssetController@store')}}" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="form-group">
				<input class="form-control" type="text" name="name" maxlength="100">
				<span>{{__('add.addname')}}</span>
			</div>
			<div class="form-group">  
				<input class="form-control" type="float" name="value" maxlength="100">
				<span>{{__('add.value')}}</span>
			</div>
			<div class="form-group">
				<label for="exampleFormControlSelect1">{{__('add.usage')}}</label>
				<select name="assetusage_id" class="form-control" id="exampleFormControlSelect1">
					@foreach($assetusage as $usage)
					<option value="{{$usage->id}}"  >{{$usage->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="exampleFormControlSelect1">{{__('add.assettype')}}</label>
				<select name="assettype_id" class="form-control" id="exampleFormControlSelect1">
				@foreach($assettypes as $type)
					<option value="{{$type->id}}"  >{{Lang::get($type->name)}}</option>
				@endforeach
				</select>
			</div>
			@if(count($liablities) > 0)
				<div class="form-group">
					<label for="exampleFormControlSelect2">
					{{__('add.liability')}}
					</label>
					<select name="liability_id" class="form-control" id="exampleFormControlSelect2">
						@foreach($liablities as $liablity_key => $liablity)
							<option value="{{ $liablity_key }}">{{ $liablity }}</option>
						@endforeach
					</select>
				</div>
			@endif
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
			<input type="submit" class="btn btn-primary">
		</form>
	</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="addimmo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">
				{{$assettype->name}}
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-style-7" method="POST" action="{{action('AssetController@store')}}" enctype="multipart/form-data">
				{{ csrf_field() }}
					<div class="form-group">
						<input class="form-control" type="text" name="name" maxlength="100">
						<span>{{__('add.entername')}}</span>
					</div>
					<div class="form-group">  
						<input class="form-control" type="number" name="value" maxlength="100">
						<span>{{__('add.entervalue')}}</span>
					</div>
					<div class="form-group">
						<label for="exampleFormControlSelect1">{{__('add.usage')}}</label>
						<select name="assetusage_id" class="form-control" id="exampleFormControlSelect1">
						@foreach($assetusage as $usage)
							<option value="{{$usage->id}}"  >{{$usage->name}}</option>
						@endforeach
						</select>
					</div>

					<div class="form-group">
						<label for="exampleFormControlSelect1">
						{{__('add.type')}}
						</label>
						<select name="assettype_id" class="form-control" id="exampleFormControlSelect1">
							@foreach($assettypes as $type)
								<option value="{{$type->id}}"  >{{$type->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="exampleFormControlSelect1">
						{{__('add.liablity')}}
						</label>
						<select name="liablity_id" class="form-control" id="exampleFormControlSelect1">
							@foreach($assettypes as $type)
								<option value="{{$type->id}}"  >{{$type->name}}</option>
							@endforeach
						</select>
					</div>
					<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
					<input type="submit" class="btn btn-primary">
				</form>
			</div>
	</div>
</div>
@endsection
