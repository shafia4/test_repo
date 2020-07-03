@extends('layouts.app')

@extends('layouts.navbar')

@section('content')

@if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif

@if (session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif


<table class="table table-hover table-striped">
  <thead>
    <tr>

      <th scope="col">{{__('add.name')}}</th>
      <th scope="col">{{__('add.email')}}</th>
      <th scope="col">{{__('add.telnr')}}</th>
      <th scope="col">{{__('add.passcode')}}</th>
      <th scope="col">{{__('add.grace')}}</th>
      <th scope="col">{{__('add.message')}}</th>
      <th scope="col">{{__('add.active')}}</th>
      <th scope="col">{{__('add.lastedit')}}</th>
      <th scope="col">{{__('add.edit')}}</th>
      <th scope="col">{{__('add.delete')}}</th>
    </tr>
  </thead>

  <tbody>

    @foreach($inherers as $inherer)



    <tr>
      <th scope="row">{{$inherer->name}} , {{$inherer->prename}}</th>
      <td>{{$inherer->email}}</td>
      <td>{{$inherer->telnr}}</td>
      <td>{{$inherer->passcode}}
        <form method="POST" action="{{action('InhererController@updatepasscode')}}">
          {{ csrf_field() }}

          <input type="hidden" name="_method" value="PUT"> </input>
          <input type="hidden" name="inhererid" value="{{$inherer->id}}">
          <input type="submit" value="{{__('add.generatenewcode')}}" class="btn btn-xs btn-outline-primary btn-sm" name="update"></input>

        </form>
      </td>
      <td>@if($inherer->graceperiod=='0')
        -
        @else {{($inherer->graceperiod/60/60/24)}} days @endif</td>
      <td>{{$inherer->message}}</td>
      <td>{{$inherer->is_active}}</td>
      <td>{{$inherer->updated_at->diffForHumans()}}</td>
      <td><i class="far fa-edit" type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit{{$inherer->id}}"></i></td>
      <td> <i class="fas fa-trash" type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete{{$inherer->id}}"></i> </td>

    </tr>





    @endforeach
  </tbody>
</table>


@foreach($inherers as $inherer)
<div class="modal fade" id="delete{{$inherer->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do you really want to delete the inhrerer {{$inherer->name}}, {{$inherer->prename}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="{{action('InhererController@destroy', $inherer->id)}}" method="POST">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <input type="submit" class="btn btn-primary" value="delete"></button></form>
      </div>
    </div>
  </div>
</div>
@endforeach


@foreach($inherers as $inherer)

<div class="modal fade" id="edit{{$inherer->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1>edit {{$inherer->name}}, {{$inherer->prename}} </h1>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="POST" action="{{action('InhererController@update',$inherer->id)}}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="PUT"></input>


          <div class="form-group">
            <label for="email">{{$inherer->email}}</label>
            <input type="email" class="form-control" name="email" placeholder="{{$inherer->email}}">
          </div>
          <div class="form-group">
            <label for="tel">{{$inherer->telnr}}</label>
            <input type="tel" class="form-control" name="telnr" placeholder="{{$inherer->telnr}}">
            <small id="graceperiodhelp" class="form-text text-muted">{{__('add.telnr')}}</small>
          </div>

          <div class="form-group">
            <label for="graceperiod">{{__('add.grace')}}</label>

            <select class="form-control" name="graceperiod">

              <option @if(($inherer->graceperiod)==0) selected @endif value="0">{{__('add.always')}}</option>
              <option @if(($inherer->graceperiod)==86400) selected @endif value="86400">{{__('add.24h')}}</option>
              <option @if(($inherer->graceperiod)==259200) selected @endif value="259200">{{__('add.3d')}}</option>
              <option @if(($inherer->graceperiod)==604800) selected @endif value="604800">{{__('add.7d')}}</option>
              <option @if(($inherer->graceperiod)==1209600) selected @endif value="1209600">{{__('add.14d')}}</option>
              <option @if(($inherer->graceperiod)==5184000) selected @endif value="5184000">{{__('add.60d')}}</option>
            </select>
            <small id="graceperiodhelp" class="form-text text-muted">{{__('add.graceexplain')}}</small>
          </div>
          <div>{{$inherer->message}}</div>
          <div class="form-check">
            <textarea rows="4" cols="50" class="form-control" name="message" placeholder="{{$inherer->message}}" id="active">
    </textarea>
            <small id="graceperiodhelp" class="form-text text-muted">{{__('add.message')}}</small>

          </div>

          <div class="form-check">
            @if($inherer->is_active == 1)
            <input type="checkbox" class="form-check-input" name="is_active" value="0">
            <label class="form-check-label" for="active">{{__('add.deactivate')}}</label>
            @else
            <input type="checkbox" class="form-check-input" name="is_active" value="1">
            <label class="form-check-label" for="active">{{__('add.makeactive')}}</label>
            @endif
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
        </form>

      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>



@endforeach

@endsection