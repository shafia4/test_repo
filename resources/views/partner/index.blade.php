
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
      <th scope="col">{{__('add.contactperson')}}</th>
      <th scope="col">{{__('add.email')}}</th>
      <th scope="col">{{__('add.telnr')}}</th>
      <th scope="col">{{__('add.adress')}}</th>
      <th scope="col">{{__('add.city')}}</th>
      <th scope="col">{{__('add.contracts')}}</th>
      <th scope="col">{{__('add.edit')}}</th>
      <th scope="col">{{__('add.delete')}}</th>
    </tr>
  </thead>

    <tbody>

  @foreach($partners as $partner)



    <tr>
      <th scope="row"> <a href="{{route('partner.show',$partner->id)}}">
      {{$partner->name}} 

       @if(isset($partner->photo))

       @foreach($partner->photo as $partnerphoto)

                 
          <img src="{{asset('photos')}}/{{$partnerphoto->path}}" style="max-width:150px;" class="img-xs img-thumbnail rounded" alt="Responsive image">
          @endforeach
             
          @endif

          </a>

      </th>
      <th >{{$partner->contactperson}}</th>
      <td>{{$partner->email}}</td>
      <td>{{$partner->tel}}</td>
      <td>{{$partner->street}}</td>
      <td>{{$partner->city}}</td>
      <td><ul> @foreach($partner->contract as $partnercontract)
       
       <a href="{{route('asset.show',$partnercontract->asset['id'])}}">
        <small><span class="badge badge-light">
{{$partnercontract->asset['name']}}  {{$partnercontract->name}} </span>
  </small>
</a>
@endforeach
</ul>
</td>
      <td><i class="far fa-edit" type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit{{$partner->id}}"></a></i></td>
      <td> <i class="fas fa-trash" type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete{{$partner->id}}"></i> </td>
     
    </tr>





@endforeach
  </tbody>
</table>


@foreach($partners as $partner)
<div class="modal fade" id="delete{{$partner->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do you really want to delete the Partner {{$partner->name}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="{{action('PartnerController@destroy', $partner->id)}}" method="POST">
        	{{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="submit" class="btn btn-primary" value="delete"></button></form>
      </div>
    </div>
  </div>
</div>
@endforeach


@foreach($partners as $partner)

<div class="modal fade" id="edit{{$partner->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1>edit {{$partner->name}} </h1>
            @if(isset($partner->photo))
             @foreach($partner->photo as $partnerphoto)  

                   
          <img src="{{asset('photos')}}/{{$partnerphoto->path}}" style="max-width:150px;" class="img-xs img-thumbnail rounded" alt="Responsive image">  <i class="fas fa-trash" type="button" class="btn btn-primary" data-toggle="modal" data-target="#deletephoto{{$partnerphoto->id}}"></i>

              @endforeach
                 
              @endif
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<form method="POST" action="{{action('PartnerController@update',$partner->id)}}" enctype="multipart/form-data">
   {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT"></input>
  
  <div class="form-group">
    <label for="contactperson">contactperson</label>
    <input type="contactperson" class="form-control" name="contactperson" placeholder="{{$partner->contactperson}}">
  </div>
  

  <div class="form-group">
    <label for="email">email</label>
    <input type="email" class="form-control" name="email" placeholder="{{$partner->email}}">
  </div>

  <div class="form-group">
    <label for="tel">telefonenr</label>
    <input type="tel" class="form-control" name="tel" placeholder="{{$partner->tel}}">
     <small id="graceperiodhelp" class="form-text text-muted">change telnr</small>
  </div>

   <div class="form-group">
    <label for="tel">Adress</label>
    <input type="text" class="form-control" name="street" placeholder="{{$partner->street}}">
     <small  class="form-text text-muted">change Adress</small>
  </div>

   <div class="form-group">
    <label for="tel">City</label>
    <input type="text" class="form-control" name="city" placeholder="{{$partner->city}}">
     <small  class="form-text text-muted">change city</small>
  </div>

  <div class="form-group">
    <label for="tel">ID Number</label>
    <input type="text" class="form-control" name="idnumber" placeholder="{{$partner->idnumber}}">
     <small  class="form-text text-muted">change ID Number</small>
  </div>

    <div class="form-group">
    <label for="tel">Upload ID Photos</label>
    <input type="file" class="form-control"  name="photo">
     <small " class="form-text text-muted">Upload a Photo/scan of the ID</small>
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


@foreach($partners as $partner)
@foreach($partner->photo as $partnerphoto)


<div class="modal fade" id="deletephoto{{$partnerphoto->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do you really want to delete the Photo
        <img src="{{asset('photos')}}/{{$partnerphoto->path}}" class="img-thumbnail rounded" alt="Responsive image">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="{{action('PartnerController@deletephoto', $partnerphoto->id)}}" method="POST">
          {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="submit" class="btn btn-primary" value="delete"></button></form>
      </div>
    </div>
  </div>
</div>

@endforeach
@endforeach


@endsection