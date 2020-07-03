@extends('layouts.app')

@extends('layouts.navbar')

@section('content')

	@if(count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach 
			</ul>
		</div>
    @endif 

<h1>{{$asset->name}}</h1>
<small>{{__('add.lastedit')}} {{$asset->updated_at->diffForHumans()}}</small><br>
<a href="{{route('asset.show',$asset->id)}}">{{__('add.show')}}</a>
<hr>
<div class="row">
	<div class="col-md-5" style="margin-left:20px">

	@if(session()->has('message'))
		<div class="alert alert-success">
			{{ session()->get('message') }}
		</div>
	@endif
	<form method="POST" action="{{action('AssetController@update',$asset->id)}}" enctype="multipart/form-data">
		{{ csrf_field() }}
		<input type="hidden" name="_method" value="PUT"></input>
			<table>
				<tr><th>{{__('add.value')}}</th><td>  
				<div class="form-group">
					<input class="form-control" name="value" type="text" placeholder="{{$asset->value}}"> 
				</div> 
			</td>
		</tr>
		<tr><th>{{__('add.currency')}}</th><td>   
			<div class="form-group">
				<select name="currency_id" class="form-control" id="exampleFormControlSelect1">
				@foreach($currency as $curr)
					@if($asset->currency_id==$curr->id) <option selected value="{{$curr->id}}">{{$curr->name}}</option> @else <option value="{{$curr->id}}">{{$curr->name}}</option>  @endif
				@endforeach
				</select>
			</div>
		</td>
		</tr>
		<tr><th>{{__('add.valbasis')}} </th><td>  
			<select class="form-control" name="valuebase"> 
				{{$asset->valuebaseselect()}}
			</select> 
			<small>{{lang::get($asset->valuebase)}}</small>
          </td>
        </tr>
            
           <tr><th>{{__('add.assettype')}}</th><td>  <hr>
             <select class="form-control" name="assettype_id">
                  @foreach($assettypes as $assettype)
                      @if($asset->assettype_id==$assettype->id)
                         <option value="{{$assettype->id}}" selected> {{Lang::get($assettype->name)}}  </option>
                          @else
                        <option value="{{$assettype->id}}" > {{Lang::get($assettype->name)}} </option>
                     @endif
                  @endforeach
             </select> 
             </td>
            </tr>
            
            @if(count($liablities) > 0)
				<tr><th>
				{{__('add.liability')}}
				</th><td>  <hr>
					<select name="liability_id" class="form-control" id="exampleFormControlSelect2">
						@php $liabilitySel = ''; @endphp
						@foreach($liablities as $liablity_key => $liablity)
							@if($asset->liability_id==$liablity_key)
								@php $liabilitySel = 'selected'; @endphp
							@else
								@php $liabilitySel = ''; @endphp
							@endif
							<option value="{{ $liablity_key }}" {{ $liabilitySel }}>{{ $liablity }}</option>
						@endforeach
					</select>
				</td>
            </tr>
			@endif


            <tr><th>{{__('add.usage')}}</th><td> 
                <select class="form-control" name="assetusage_id">
                  @foreach($assetusage as $assettype)
                    @if($asset->assetusage_id==$assettype->id)
                    <option value="{{$assettype->id}}" selected>{{$assettype->name}}</option>
                    @else
                     <option value="{{$assettype->id}}" >{{$assettype->name}}</option>
                    @endif
                 @endforeach
              </select>
             </td>
           </tr>

            
             @if($asset->assettype->name =='assettype.immo')
            <tr>
              <th>{{__('add.adress')}}</th><td> <p><input class="form-control" type="text" name="city" placeholder="{{$asset->city}}"></p><p><input class="form-control" type="text" name="street" placeholder="{{$asset->street}}"> </p></td></tr>
              @if($asset->assetusage->name =='rent')
             <tr><th>{{__('add.yearlinc')}}</th><td> <input class="form-control" type="text" name="revenue" placeholder="{{$asset->revenue}}"></td></tr>
             <tr><th>{{__('add.yearlexp')}}</th><td> <input class="form-control" type="text" name="cost" placeholder="{{$asset->costs}}"> </td></tr>
             @endif
             @endif

             @if($asset->assettype->name =='assettype.crowdfunding')
             <tr>
              @foreach($asset->partner as $assetpartner)
              <th>{{__('add.company')}}</th><td> <input class="form-control" type="text" name="partner" placeholder="{{$assetpartner->name}}"> </td></tr>
              @endforeach
             <tr><th>{{__('add.interest')}}</th><td> <input class="form-control" type="text" name="interest" placeholder="{{$asset->interest}}"> %</td></tr>
             <tr><th>{{__('add.term')}}</th><td> <input class="form-control" type="text" name="term" placeholder="{{$asset->term}}"> </td></tr>
             <tr><th>{{__('add.enddate')}} </th><td> <input class="form-control" type="text" name="enddate" placeholder="{{$asset->enddate}}"> </td></tr>
  
             
             @endif

             @if($asset->assettype->name =='assettype.watch')
             <tr>
             <th>{{__('add.brand')}}</th><td> <input class="form-control" type="text" name="brand" placeholder="{{$asset->brand}}"> </td></tr>
             <tr><th>{{__('add.serialnr')}}</th><td>  <input class="form-control" type="text" name="serialnr" placeholder="{{$asset->serialnr}}"> </td></tr>
             <tr><th>{{__('add.purchasedate')}}</th><td> <input class="form-control" type="text" name="purchasedate" placeholder="{{$asset->purchasedate}}"> </td></tr>
             <tr><th>{{__('add.purchaseprice')}} </th><td> <input class="form-control" type="text" name="initialinvestment" placeholder="{{$asset->initialinvestment}}"> </td></tr>

             @endif

             @if($asset->assettype->name =='assettype.car')
             <tr>
             <th>{{__('add.brand')}}</th><td> <input class="form-control" type="text" name="brand" placeholder="{{$asset->brand}}"> </td></tr>
             <tr><th>{{__('add.chassisnr')}}</th><td>  <input class="form-control" type="text" name="serialnr" placeholder="{{$asset->serialnr}}"> </td></tr>
             <tr><th>{{__('add.licenseplate')}}</th><td>  <input class="form-control" type="text" name="licenseplate" placeholder="{{$asset->licenseplate}}"> </td></tr>
             <tr><th>{{__('add.milage')}}</th><td>  <input class="form-control" type="text" name="milage" placeholder="{{$asset->milage}}"> </td></tr>
             <tr><th>{{__('add.purchasedate')}}</th><td> <input class="form-control" type="text" name="purchasedate" placeholder="{{$asset->purchasedate}}"> </td></tr>
             <tr><th>{{__('add.purchaseprice')}} </th><td> <input class="form-control" type="text" name="initialinvestment" placeholder="{{$asset->initialinvestment}}"> </td></tr>

             @endif

             @if($asset->assettype->name =='assettype.pension')
             <tr>
             <th>{{__('add.pensionfund')}}</th><td> <input class="form-control" type="text" name="brand" placeholder="{{$asset->brand}}"> </td></tr>
             <tr><th>{{__('add.accountnr')}}</th><td>  <input class="form-control" type="text" name="serialnr" placeholder="{{$asset->serialnr}}"> </td></tr>
             <tr><th>{{__('add.employer')}}</th><td>  <input class="form-control" type="text" name="artist" placeholder="{{$asset->artist}}"> </td></tr>
             <tr><th>{{__('add.interest')}}</th><td>  <input class="form-control" type="text" name="interest" placeholder="{{$asset->interest}}"> </td></tr>
             <tr><th>{{__('add.purchasedate')}}</th><td> <input class="form-control" type="text" name="purchasedate" placeholder="{{$asset->purchasedate}}"> </td></tr>
             <tr><th>{{__('add.purchaseprice')}} </th><td> <input class="form-control" type="text" name="initialinvestment" placeholder="{{$asset->initialinvestment}}"> </td></tr>

             @endif

              @if($asset->assettype->name =='assettype.art')
             <tr>
             <th>{{__('add.artkind')}}</th><td> <input class="form-control" type="text" name="brand" placeholder="{{$asset->brand}}"> </td></tr>
             <tr><th>{{__('add.artist')}}</th><td>  <input class="form-control" type="text" name="artist" placeholder="{{$asset->artist}}"> </td></tr>
             <tr><th>{{__('add.stored')}}</th><td> <input class="form-control" type="text" name="licenseplate" placeholder="{{$asset->licenseplate}}"> </td></tr>
             <tr><th>{{__('add.purchaseprice')}} </th><td> <input class="form-control" type="text" name="initialinvestment" placeholder="{{$asset->initialinvestment}}"> </td></tr>
            <tr><th>{{__('add.purchasedate')}}</th><td> <input class="form-control" type="text" name="purchasedate" placeholder="{{$asset->purchasedate}}"> </td></tr>

             @endif

             @if($asset->assettype->name =='assettype.cash')
             <tr>
             <th>{{__('add.currency')}}</th><td> <input class="form-control" type="text" name="brand" placeholder="{{$asset->brand}}"> </td></tr>
             <tr><th>{{__('add.stored')}}</th><td> <input class="form-control" type="text" name="licenseplate" placeholder="{{$asset->licenseplate}}"> </td></tr>
            <tr><th>{{__('add.purchasedate')}}</th><td> <input class="form-control" type="text" name="purchasedate" placeholder="{{$asset->purchasedate}}"> </td></tr>

             @endif

             @if($asset->assettype->name =='assettype.gold')
             <tr>
             <th>{{__('add.metal')}}</th><td> <input class="form-control" type="text" name="brand" placeholder="{{$asset->brand}}"> </td></tr>
             <th>{{__('add.weight')}}</th><td> <input class="form-control" type="text" name="artist" placeholder="{{$asset->artist}}"> </td></tr>
             <tr><th>{{__('add.stored')}}</th><td> <input class="form-control" type="text" name="licenseplate" placeholder="{{$asset->licenseplate}}"> </td></tr>
             <tr><th>{{__('add.purchaseprice')}} </th><td> <input class="form-control" type="text" name="initialinvestment" placeholder="{{$asset->initialinvestment}}"> </td></tr>
            <tr><th>{{__('add.purchasedate')}}</th><td> <input class="form-control" type="text" name="purchasedate" placeholder="{{$asset->purchasedate}}"> </td></tr>

             @endif

             @if($asset->assettype->name =='assettype.saving')
             <tr>
             <th>{{__('add.bank')}}</th><td> <input class="form-control" type="text" name="brand" placeholder="{{$asset->brand}}"> </td></tr>
             <tr><th>{{__('add.accountnr')}}</th><td>  <input class="form-control" type="text" name="serialnr" placeholder="{{$asset->serialnr}}"> </td></tr>
             <tr><th>{{__('add.stored')}}</th><td> <input class="form-control" type="text" name="licenseplate" placeholder="{{$asset->licenseplate}}"> </td></tr>
             <tr><th>{{__('add.interest')}}</th><td>  <input class="form-control" type="text" name="interest" placeholder="{{$asset->interest}}"> </td></tr>
             <tr><th>{{__('add.purchaseprice')}} </th><td> <input class="form-control" type="text" name="initialinvestment" placeholder="{{$asset->initialinvestment}}"> </td></tr>
             <tr><th>{{__('add.purchasedate')}}</th><td> <input class="form-control" type="text" name="purchasedate" placeholder="{{$asset->purchasedate}}"> </td></tr>
            

             @endif

             @if($asset->assettype->name =='assettype.share')
             <tr>
             <th>{{__('add.company')}}</th><td> <input class="form-control" type="text" name="brand" placeholder="{{$asset->brand}}"> </td></tr>
             <tr><th>{{__('add.companyid')}}</th><td>  <input class="form-control" type="text" name="serialnr" placeholder="{{$asset->serialnr}}"> </td></tr>
             <tr><th>{{__('add.companylocation')}}</th><td> <input class="form-control" type="text" name="city" placeholder="{{$asset->city}}"> </td></tr>
             <tr> <th>{{__('add.director')}}</th><td> <input class="form-control" type="text" name="artist" placeholder="{{$asset->artist}}"> </td></tr>
             <tr><th>Anteil in %</th><td> <input class="form-control" type="text" name="licenseplate" placeholder="{{$asset->licenseplate}}"> </td></tr>
             <tr><th>{{__('add.dividend')}}</th><td>  <input class="form-control" type="text" name="revenue" placeholder="{{$asset->revenue}}"> </td></tr>
            <tr><th>{{__('add.costs')}}</th><td>  <input class="form-control" type="text" name="cost" placeholder="{{$asset->costs}}"> </td></tr>
            <tr><th>{{__('add.purchaseprice')}} </th><td> <input class="form-control" type="text" name="initialinvestment" placeholder="{{$asset->initialinvestment}}"> </td></tr>
             <tr><th>{{__('add.purchasedate')}}</th><td> <input class="form-control" type="text" name="purchasedate" placeholder="{{$asset->purchasedate}}"> </td></tr>
            

             @endif


             @if($asset->assettype->name =='assettype.stock')
             <tr>
             <th>{{__('add.company')}}</th><td> <input class="form-control" type="text" name="brand" placeholder="{{$asset->brand}}"> </td></tr>
             <tr><th>{{__('add.companyid')}}</th><td>  <input class="form-control" type="text" name="serialnr" placeholder="{{$asset->serialnr}}"> </td></tr>
             <tr><th>{{__('add.amount')}}</th><td> <input class="form-control" type="text" name="licenseplate" placeholder="{{$asset->licenseplate}}"> </td></tr>
             <tr><th>{{__('add.depot')}}</th><td> <input class="form-control" type="text" name="brand" placeholder="{{$asset->brand}}"> </td></tr>
             <tr><th>{{__('add.depotnr')}}</th><td>  <input class="form-control" type="text" name="serialnr" placeholder="{{$asset->serialnr}}"> </td></tr>
             <tr><th>{{__('add.dividend')}}</th><td>  <input class="form-control" type="text" name="revenue" placeholder="{{$asset->revenue}}"> </td></tr>
             <tr><th>{{__('add.purchasedate')}}</th><td> <input class="form-control" type="text" name="purchasedate" placeholder="{{$asset->purchasedate}}"> </td></tr>
             <tr><th>{{__('add.purchaseprice')}} </th><td> <input class="form-control" type="text" name="initialinvestment" placeholder="{{$asset->initialinvestment}}"> </td></tr>
            

             @endif

             @if($asset->assettype->name =='assettype.bond')
             <tr>
             <th>{{__('add.company')}}</th><td> <input class="form-control" type="text" name="brand" placeholder="{{$asset->brand}}"> </td></tr>
             <tr><th>{{__('add.amount')}}</th><td> <input class="form-control" type="text" name="licenseplate" placeholder="{{$asset->licenseplate}}"> </td></tr>
             <tr><th>{{__('add.depot')}}</th><td> <input class="form-control" type="text" name="brand" placeholder="{{$asset->brand}}"> </td></tr>
             <tr><th>{{__('add.depotnr')}}</th><td>  <input class="form-control" type="text" name="serialnr" placeholder="{{$asset->serialnr}}"> </td></tr>
             <tr><th>{{__('add.interest')}}</th><td>  <input class="form-control" type="text" name="interest" placeholder="{{$asset->interest}}"> </td></tr>
             <tr><th>K{{__('add.purchasedate')}}</th><td> <input class="form-control" type="text" name="purchasedate" placeholder="{{$asset->purchasedate}}"> </td></tr>
             <tr><th>{{__('add.enddate')}}</th><td> <input class="form-control" type="date" name="enddate" placeholder="{{$asset->enddate}}"> </td></tr>
             <tr><th>{{__('add.purchaseprice')}} </th><td> <input class="form-control" type="text" name="initialinvestment" placeholder="{{$asset->initialinvestment}}"> </td></tr>
 
             @endif

          

             @if($asset->assettype->name =='assettype.other')
             <tr>
             <th>{{__('add.description')}}</th><td> <input class="form-control" type="text" name="brand" placeholder="{{$asset->brand}}"> </td></tr>
             <tr><th>{{__('add.numer')}}</th><td>  <input class="form-control" type="text" name="serialnr" placeholder="{{$asset->serialnr}}"> </td></tr>
             <tr><th>{{__('add.amount')}}</th><td> <input class="form-control" type="text" name="licenseplate" placeholder="{{$asset->licenseplate}}"> </td></tr>
             <tr><th>{{__('add.rand')}}</th><td> <input class="form-control" type="text" name="brand" placeholder="{{$asset->brand}}"> </td></tr>
             <tr><th>{{__('add.interest')}}</th><td>  <input class="form-control" type="text" name="interest" placeholder="{{$asset->interest}}"> </td></tr>
             <tr><th>{{__('add.income')}}</th><td>  <input class="form-control" type="text" name="revenue" placeholder="{{$asset->revenue}}"> </td></tr>
            <tr><th>{{__('add.cost')}}</th><td>  <input class="form-control" type="text" name="cost" placeholder="{{$asset->costs}}"> </td></tr>
             <tr><th>{{__('add.purchasedate')}}</th><td> <input class="form-control" type="text" name="purchasedate" placeholder="{{$asset->purchasedate}}"> </td></tr>
             <tr><th>{{__('add.enddate')}} </th><td> <input class="form-control" type="date" name="enddate" placeholder="{{$asset->enddate}}"> </td></tr>
             <tr><th>{{__('add.purchaseprice')}} </th><td> <input class="form-control" type="text" name="initialinvestment" placeholder="{{$asset->initialinvestment}}"> </td></tr>
            

             @endif


              <tr><th>{{__('add.notes')}}</th><td>
                <small>{{$asset->notes}}</small>
               <textarea class="form-control" type="text" name="notes" placeholder="{{$asset->notes}}"> </textarea> </td></tr>



            <tr><th> <strong>Documents, Photos and Contracts</strong> </th></tr>

             <tr><th>

              <input class="form-control" type="text" name="documentname" placeholder="{{__('add.name')}}"></th><td>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">{{__('add.docs')}}</span>
                  </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                      aria-describedby="inputGroupFileAddon01" name="document">
                    <label class="custom-file-label" for="inputGroupFile01">{{__('add.fileselect')}}</label>
                  </div>
                </div>
              </td></tr>
              <tr>
                  
              </tr>

              <tr><th>
              </th><td>

              </td></tr>



             <tr><th>{{__('add.contracts')}}</th><td>

                <a href="#" data-toggle="modal" data-target="#adddocumentmodal"> <button type="button" class="btn btn-primary"> {{__('add.uploadcontract')}}</button></a>

            </td></tr>

            <tr><th>{{__('add.uploadphotos')}}</th><td><div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon02">{{__('add.photos')}}</span>
                  </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile02"
                      aria-describedby="inputGroupFileAddon01" name="photo">

                    <label class="custom-file-label" for="inputGroupFile01">{{__('add.fileselect')}}</label>
                  </div>
                </div></td></tr>

          



                          <tr><th>
              </th><td><ul>
                @foreach($asset->document as $assetdocument)
                <li>
                  
                <a target="_blank" rel="noopener noreferrer" href="{{asset('documents')}}/{{$assetdocument->path}}">{{$assetdocument->name}}</a>
                <i class="fas fa-trash" type="button" class="btn btn-primary" data-toggle="modal" data-target="#deletedocument{{$assetdocument->id}}"></i>
              
              </a>
              </li>
              @endforeach

                </ul>

              </td></tr>

             <tr><th></th><td>


                                  <ul>
                                    @foreach($asset->contract as $assetcontract)
                                    <li><a  href="#" data-toggle="modal" data-target="#editmodalid{{$assetcontract->id}}">{{$assetcontract->name}}</a></li>
                                    @endforeach
                                  </ul> 

            </td></tr>

             <tr><th>Fotos</th><td>


                                  <ul>
                                    @foreach($asset->photo as $assetfoto)
                                    <li><a href="">{{$assetfoto->path}}</a></li>
                                    @endforeach
                                  </ul> 

            </td></tr>
             

             <tr>
              <th>
             <input class="btn btn-primary" type="submit"  value="{{__('add.save')}}"></input></th>
             </tr>

        </table>
      </form>
      <i class="fas fa-trash" type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteasset"></i>

    </div>


    	


    <div class="col-md-6" style="background-color:lightgrey">

     <table>
          @if(isset($asset->photo))
          <div class="row">
          @foreach ($asset->photo as $assetphoto)
          <div>
          <i class="fas fa-trash" type="button" class="btn btn-primary" data-toggle="modal" data-target="#deletephoto{{$assetphoto->id}}"></i>
          <img src="{{asset('photos')}}/{{$assetphoto->path}}" class="img-thumbnail rounded" alt="Responsive image"> </div>
          @endforeach
          </div>
          @endif
           
        </table>
      </div>

</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="adddocumentmodal" tabindex="-1" role="dialog" aria-labelledby="adddocumentTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="adddocumentTitle">{{__('add.fileselct')}} {{$asset->name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{action('AssetController@addcontract', $asset->id)}}" enctype="multipart/form-data" >
           {{ csrf_field() }}

          <div class="form-group">
          <input class="form-control" type="text" name="name" placeholder="Name">
          <small id="nameHelp" class="form-text text-muted">{{__('add.entername')}}</small>
          </div>

          <div class="form-group">
           <select class="form-control" type="select" name="partner_id">
            <option value="0">none</option>
            @foreach($partners as $partner)
            <option value="{{$partner->id}}">{{$partner->name}}</option>
            @endforeach
           

           </select>
           
           <small  id="terminationHelp" class="form-text text-muted">Choose the Partner</small>
          </div>
          
          <div class="form-group">
          <input class="form-control" type="file"  name="document">
          <small id="documentHelp" class="form-text text-muted">{{__('add.uploadcontract')}}</small>
          </div>

          <div class="form-group">
          <input class="form-control" type="text" name="value" placeholder="wert">
          <small id="valueHelp" class="form-text text-muted">{{__('add.valueeur')}}</small>
          </div>

           <div class="form-group">
           <input type="text" name="storedlocation" placeholder="Aufbewahrungsort">
           <small  id="locationHelp" class="form-text text-muted">{{__('add.wherecontract')}}</small>
          </div>

           <div class="form-group">
           <input class="form-control" type="date" name="agreedon" placeholder="Datum">
           <small  id="agreedonHelp" class="form-text text-muted">{{__('add.agreementdate')}}</small>
          </div>


          <div class="form-group">
           <input class="form-control" type="date" name="termination" placeholder="Datum">
           <small  id="terminationHelp" class="form-text text-muted">{{__('add.terminationdate')}}</small>
          </div>

          <div class="form-group">
           <select class="form-control" type="select" name="
           ">
             <option value='none'>{{__('add.remindnone')}}</option>
             <option value='5'>{{__('add.remind5r')}}</option>
             <option value='15'>{{__('add.remind15r')}}</option>
             <option value='1'>{{__('add.remind0r')}}</option>


           </select>
           
           <small  id="terminationHelp" class="form-text text-muted">{{__('add.regremind')}}</small>
          </div>

          <div class="form-group">
           <select class="form-control" type="select" name="reminderterm">
             <option value='none'>{{__('add.remindnone')}}</option>
             <option value='90'>{{__('add.remind90')}}</option>
             <option value='30'>{{__('add.remind30')}}</option>
             <option value='14'>{{__('add.remind14')}}</option>
             <option value='7'>{{__('add.remind7')}}</option>
             <option value='1'>{{__('add.remind0')}}</option>
            


           </select>
           
           <small  id="terminationHelp" class="form-text text-muted">{{__('add.lastremind')}}</small>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('add.close')}}</button>
        <input type="submit" value="submit" class="btn btn-primary">
      </div>
      </form>
    </div>
  </div>
</div>


@foreach($asset->contract as $assetcontract)
<div class="modal fade" id="editmodalid{{$assetcontract->id}}" tabindex="-1" role="dialog" aria-labelledby="adddocumentTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="adddocumentTitle">{{__('add.editcontract')}} {{$assetcontract->name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{action('AssetController@changecontract', $assetcontract->id)}}" enctype="multipart/form-data" >
           {{ csrf_field() }}
           <table> <input type="hidden" name="_method" value="PUT"></input>
         <tr> <td>{{__('add.contractname')}}</td><td><input type="text" name="name" placeholder="{{$assetcontract->name}}"></td></tr>
         <tr><td>{{__('add.partner')}} 
          @foreach($assetcontract->partner as $assetcontractpartner)<a href=""><small>{{$assetcontractpartner->name}}</small></a>@endforeach </td> 
          <td> <input type="hidden" name="asset_id" value="{{$asset->id}}">
             @if (isset($assetcontract->partner->name))<a href="">{{$assetcontract->partner->name}}</a>
          @endif

          <div class="form-group">
            
           <select class="form-control" type="select" name="partner">
             <option name="partner_id" value='0'>{{__('add.none')}}</option>
             @foreach($partners as $partner)
             
             <option name="partner_id" @foreach($assetcontract->partner as $assetcontractpartner) @if ($assetcontractpartner->id==$partner->id) selected @endif    @endforeach value='{{$partner->id}}'>{{$partner->name}}</option>
          
             @endforeach
          
           </select>
                    <small  id="terminationHelp" class="form-text text-muted">{{__('add.partner')}}</small>
          </div>

        
          

        </td></tr>

     
         <tr> <td>{{__('add.stored')}}</td><td> <input type="text" name="storedlocation" placeholder="{{$assetcontract->storedlocation}}"></td></tr>
         <tr> <td>{{__('add.agreementdate')}} </td><td> <input type="date" name="agreedon" placeholder="{{$assetcontract->agreedon}}"> - {{date("d.m.Y",$assetcontract->agreedon)}}</td></tr>
         <tr>  <td>{{__('add.terminationdate')}} {{date("d.m.Y",$assetcontract->termination)}} </td><td><input type="date"  name="termination"> -  {{date("d.m.Y",$assetcontract->termination)}}</td></tr>
         <tr> <td>{{__('add.reminder')}} </td><td> 
          



          <div class="form-group">
           <select class="form-control" type="select" name="reminderreg">
            <option value='add.none' @if ($assetcontract->reminderreg=='add.none') selected @endif >{{__('add.none')}}</option>
             <option value='remind5r' @if ($assetcontract->reminderreg=='remind5r') selected @endif  >{{__('add.remind5r')}}</option>
             <option value='remind15r' @if ($assetcontract->reminderreg=='remind15r') selected @endif >{{__('add.remind15r')}}</option>
             <option value='remind0r' @if ($assetcontract->reminderreg=='remind0r') selected @endif >{{__('add.remind0r')}}</option>


           </select>
           
           <small  id="terminationHelp" class="form-text text-muted">{{__('add.regremind')}}</small>
          </div>

          <div class="form-group">
           <select class="form-control" type="select" name="reminderterm">
             <option value='add.remindnone' @if ($assetcontract->reminderterm=='add.remindnone') selected @endif>{{__('add.remindnone')}}</option>
             <option value='add.remind90' @if ($assetcontract->reminderterm=='add.remind90') selected @endif >{{__('add.remind90')}}</option>
             <option value='add.remind30' @if ($assetcontract->reminderterm=='add.remind30') selected @endif>{{__('add.remind90')}}</option>
             <option value='add.remind14' @if ($assetcontract->reminderterm=='add.remind14') selected @endif>{{__('add.remind14')}}</option>
             <option value='add.remind7' @if ($assetcontract->reminderterm=='add.remind7') selected @endif>{{__('add.remind7')}}</option>
             <option value='add.remind0' @if ($assetcontract->reminderterm=='add.remind0') selected @endif>{{__('add.remind0')}}</option>
            


           </select>
           
           <small  id="terminationHelp" class="form-text text-muted">{{__('add.lastremind')}}</small>
          </div>




           <tr>  <td></td> <td><object type="application/pdf" data="{{asset('contracts')}}/{{$assetcontract->path}}"></object></td>
              
</tr>

       </td></tr>
          <tr> <td>{{__('add.uploadcontract')}}</td> <td><input type="file"  name="document"></td></tr>
      </div>
      <div class="modal-footer">
        
      <tr> <td>   <input type="submit" value="submit" class="btn btn-primary"> </td></tr>
       <tr> <td>   <i class="fas fa-trash" type="button" class="btn btn-primary" data-toggle="modal" data-target="#deletecontract{{$assetcontract->id}}"></i> </td></tr>
      </div>
      </table>
      </form>
     
     
      
    </div>
  </div>
</div>
</div>
@endforeach

@foreach($asset->contract as $assetcontract)
<div class="modal fade" id="deletecontract{{$assetcontract->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{__('add.deletepartner')}} {{$assetcontract->name}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('add.close')}}</button>
        <form action="{{action('AssetController@deletecontract', $assetcontract->id)}}" method="POST">
          {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="submit" class="btn btn-primary" value="delete"></button></form>
      </div>
    </div>
  </div>
</div>
@endforeach

@foreach($asset->photo as $assetphoto)
<div class="modal fade" id="deletephoto{{$assetphoto->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      {{__('add.deletephoto')}} ?
        <img src="{{asset('photos')}}/{{$assetphoto->path}}" class="img-thumbnail rounded" alt="Responsive image">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('add.close')}}</button>
        <form action="{{action('AssetController@deletephoto', $assetphoto->id)}}" method="POST">
          {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="submit" class="btn btn-primary" value="delete"></button></form>
      </div>
    </div>
  </div>
</div>
@endforeach

@foreach($asset->document as $assetdocument)
<div class="modal fade" id="deletedocument{{$assetdocument->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{__('add.deletedoc')}}{{$assetdocument->name}} ?
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('add.close')}}</button>
        <form action="{{action('AssetController@deletedocument', $assetdocument->id)}}" method="POST">
          {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="submit" class="btn btn-primary" value="delete"></button></form>
      </div>
    </div>
  </div>
</div>
@endforeach

<div class="modal fade" id="deleteasset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{__('add.deleteasset')}} {{$asset->name}} {{__('add.deleteasset1')}}
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('add.close')}}</button>
  <form method='POST' action="{{action('AssetController@destroy', $asset->id)}}" >
             

           <input type="hidden" name="_method" value="delete"></input>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <tr>
              <th>
             <input type="submit"  value="delete"></input></th>
             </tr>
        
      </form>

      </div>
    </div>
  </div>
</div>



@endsection
