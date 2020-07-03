
@extends('layouts.app')
@extends('layouts.navbar')


@section('content')

<div class="container" >
<h1>{{$asset->name}}</h1>
 <small><span class="badge badge-light">
{{__('add.added')}} {{$asset->created_at->diffForHumans()}}  </span>
  </small>

 <p class="font-weight-bold">
<span class="badge badge-secondary" style="background-color:lightgreen">{{__('add.lastedit')}} {{$asset->updated_at->diffForHumans()}}  </span></p>
  <br>
    @if($asset->user->id == Auth::user()->id)
<p><a href="{{route('asset.edit',$asset->id)}}"> {{__('add.edit')}} </a></p>
@endif
<hr>
<div class="row">

  @if(isset($asset->photo[0]))
  <div class="col-md-6" style="border-style:solid; border-width:1px; border-radius: 15px">
    @else
    <div class="col-md-12" style="border-style:solid; border-width:1px; border-radius: 15px">
       @endif
        <table class="table">
            <tr>
              <th>{{__('add.value')}} </th>
              <td>{{$asset->value}} {{$asset->currency->name}} </td>
            </tr>
            @if ($asset->currency->name != Auth::user()->currency->name)
              <th>{{__('add.value')}}  {{Auth::user()->currency->name}}</th>
              <td>{{$asset->value*$asset->currency->tolead/Auth::user()->currency->tolead}}   {{Auth::user()->currency->name}}</td>
            </tr>
            @endif

             <tr>
              <th>{{__('add.valbasis')}} </th>
              <td>{{Lang::get($asset->valuebase)}} </td>
             </tr>

           <tr>
              <th>{{__('add.assettype')}}</th>
              <td> {{Lang::get($asset->assettype->name)}} </td>
            </tr>

            <tr>
              <th>{{__('add.usage')}}</th>
              <td> 
                @if (isset($asset->assetusage))
                {{$asset->assetusage->name}}
                @else
                 -
                @endif </td>
            </tr>
            <tr>
              <th>{{__('add.liability')}}</th>
              <td> 
                @if (!empty($liablity))
					{{$liablity['name']}}
                @else
                 -
                @endif </td>
            </tr>
              @if($asset->assettype->name =='assettype.immo')
              <tr>
                <th>{{__('add.adress')}}</th><td> {{$asset->city}}{{$asset->street}} </td></tr>
                @if($asset->assetusage->name =='rent')
                 <tr><th>{{__('add.yearlinc')}}</th><td> {{$asset->revenue}}</td></tr>
                 <tr><th>{{__('add.yearlexp')}}</th><td> {{$asset->costs}} </td></tr>
               @endif
             @endif


             @if($asset->assettype->name =='assettype.crowdfunding')
             <tr>
              
                @if (isset($assetpartner->name)) <th>{{__('add.company')}}</th><td> {{$assetpartner->name}} </td></tr>@endif
           
                   <tr><th>{{__('add.interest')}}</th><td> {{$asset->interest}} %</td></tr>
                   <tr><th>{{__('add.term')}}</th><td> {{$asset->term}}> </td></tr>
                   <tr><th>{{__('add.enddate')}} </th><td> {{$asset->enddate}} </td></tr>
  
             
             @endif

             @if($asset->assettype->name =='assettype.watch')
                 <tr>
                 <th>{{__('add.brand')}}</th><td> {{$asset->brand}} </td></tr>
                 <tr><th>{{__('add.serialnr')}}</th><td>  {{$asset->serialnr}} </td></tr>
                 <tr><th>{{__('add.purchasedate')}}</th><td> {{$asset->purchasedate}} </td></tr>
                 <tr><th>{{__('add.purchaseprice')}} </th><td> {{$asset->initialinvestment}} </td></tr>

             @endif

             @if($asset->assettype->name =='assettype.car')
                 <tr>
                 <th>{{__('add.brand')}}</th><td> {{$asset->brand}} </td></tr>
                 <tr><th>{{__('add.serialnr')}}</th><td>  {{$asset->serialnr}} </td></tr>
                 <tr><th>{{__('add.licenseplate')}}</th><td>  {{$asset->licenseplate}} </td></tr>
                 <tr><th>{{__('add.milage')}}</th><td>  {{$asset->milage}} </td></tr>
                 <tr><th>{{__('add.purchasedate')}}</th><td> {{$asset->purchasedate}} </td></tr>
                 <tr><th>{{__('add.purchaseprice')}} </th><td> {{$asset->initialinvestment}} </td></tr>

             @endif

             @if($asset->assettype->name =='assettype.pensiong')
                 <tr>
                 <th>{{__('add.pensionfund')}}</th><td> {{$asset->brand}} </td></tr>
                 <tr><th>{{__('add.accountnr')}}</th><td>  {{$asset->serialnr}} </td></tr>
                 <tr><th>{{__('add.employer')}}</th><td>  {{$asset->artist}} </td></tr>
                 <tr><th>{{__('add.interest')}}</th><td>  {{$asset->interest}} </td></tr>
                 <tr><th>{{__('add.purchasedate')}}</th><td> {{$asset->purchasedate}} </td></tr>
                 <tr><th>{{__('add.purchaseprice')}} </th><td> {{$asset->initialinvestment}} </td></tr>

             @endif

              @if($asset->assettype->name =='assettype.art')
                 <tr>
                 <th>{{__('add.artkind')}}</th><td> {{$asset->brand}} </td></tr>
                 <tr><th>{{__('add.artist')}}</th><td>  {{$asset->artist}} </td></tr>
                 <tr><th>{{__('add.storage')}}</th><td> {{$asset->licenseplate}} </td></tr>
                 <tr><th>{{__('add.purchaseprice')}} </th><td> {{$asset->initialinvestment}} </td></tr>
                <tr><th>{{__('add.purchasedate')}}</th><td> {{$asset->purchasedate}} </td></tr>

             @endif

             @if($asset->assettype->name =='assettype.cash')
                 <tr>
                 <th>{{__('add.currency')}}</th><td> {{$asset->brand}} </td></tr>
                 <tr><th>{{__('add.storage')}}</th><td> {{$asset->licenseplate}} </td></tr>
                <tr><th>{{__('add.purchasedate')}}</th><td> {{$asset->purchasedate}} </td></tr>

             @endif

             @if($asset->assettype->name =='assettype.gold')
                 <tr>
                 <th>{{__('add.metal')}}</th><td> {{$asset->brand}} </td></tr>
                 <th>{{__('add.weight')}}</th><td> {{$asset->artist}} </td></tr>
                 <tr><th>{{__('add.storage')}}</th><td> {{$asset->licenseplate}} </td></tr>
                 <tr><th>{{__('add.purchaseprice')}} </th><td> {{$asset->initialinvestment}} </td></tr>
                <tr><th>{{__('add.purchasedate')}}</th><td> {{$asset->purchasedate}} </td></tr>

             @endif

             @if($asset->assettype->name =='assettype.saving')
                 <tr>
                 <th>Bank</th><td> {{$asset->brand}} </td></tr>
                 <tr><th>{{__('add.accountnr')}}</th><td>  {{$asset->serialnr}} </td></tr>
                 <tr><th>{{__('add.depot')}}</th><td> {{$asset->licenseplate}} </td></tr>
                 <tr><th>{{__('add.interest')}}</th><td>  {{$asset->interest}} </td></tr>
                 <tr><th>{{__('add.purchaseprice')}} </th><td> {{$asset->initialinvestment}} </td></tr>
                 <tr><th>{{__('add.purchasedate')}}</th><td> {{$asset->purchasedate}} </td></tr>
            

             @endif

             @if($asset->assettype->name =='assettype.share')
                 <tr>
                 <th>Firma</th><td> {{$asset->brand}} </td></tr>
                 <tr><th>{{__('add.companyid')}}</th><td>  {{$asset->serialnr}} </td></tr>
                 <tr><th>{{__('add.companylocation')}}</th><td> {{$asset->city}} </td></tr>
                 <tr> <th>{{__('add.director')}}</th><td> {{$asset->artist}} </td></tr>
                 <tr><th>{{__('add.share')}}</th><td> {{$asset->licenseplate}} </td></tr>
                 <tr><th>{{__('add.dividend')}}</th><td>  {{$asset->revenue}} </td></tr>
                <tr><th> {{__('add.yearlcost')}}</th><td>  {{$asset->costs}}</td></tr>
                <tr><th>{{__('add.purchaseprice')}} </th><td> {{$asset->initialinvestment}} </td></tr>
                 <tr><th>{{__('add.purchasedate')}}</th><td> {{$asset->purchasedate}} </td></tr>
            

             @endif


             @if($asset->assettype->name =='assettype.stock')
                 <tr>
                 <th>Firma</th><td> {{$asset->brand}} </td></tr>
                 <tr><th>{{__('add.companyid')}}</th><td>  {{$asset->serialnr}} </td></tr>
                 <tr><th>{{__('add.amount')}}</th><td> {{$asset->licenseplate}} </td></tr>
                 <tr><th>{{__('add.depot')}}</th><td> {{$asset->brand}} </td></tr>
                 <tr><th>{{__('add.depotnr')}}</th><td>  {{$asset->serialnr}} </td></tr>
                 <tr><th>{{__('add.dividend')}}</th><td>  {{$asset->revenue}} </td></tr>
                 <tr><th>{{__('add.purchasedate')}}</th><td> {{$asset->purchasedate}} </td></tr>
                 <tr><th>{{__('add.purchaseprice')}} </th><td> {{$asset->initialinvestment}} </td></tr>
                

             @endif

             @if($asset->assettype->name =='assettype.bond')
                 <tr>
                 <th>Firma</th><td> {{$asset->brand}} </td></tr>
                 <tr><th>{{__('add.depot')}}</th><td> {{$asset->licenseplate}} </td></tr>
                 <tr><th>{{__('add.enddate')}}</th><td> {{$asset->brand}} </td></tr>
                 <tr><th>{{__('add.depotnr')}}</th><td>  {{$asset->serialnr}} </td></tr>
                 <tr><th>{{__('add.interest')}}</th><td>  {{$asset->interest}} </td></tr>
                 <tr><th>{{__('add.purchasedate')}}</th><td> {{$asset->purchasedate}} </td></tr>
                 <tr><th>{{__('add.enddate')}} </th><td> {{$asset->enddate}} </td></tr>
                 <tr><th>{{__('add.purchaseprice')}} </th><td> {{$asset->initialinvestment}} </td></tr>
                

             @endif

          

             @if($asset->assettype->name =='assettype.other')
                 <tr>
                 <th>{{__('add.description')}}</th><td> {{$asset->brand}} </td></tr>
                 <tr><th>{{__('add.serialnr')}}</th><td>  {{$asset->serialnr}} </td></tr>
                 <tr><th>{{__('add.amount')}}</th><td> {{$asset->licenseplate}} </td></tr>
                 <tr><th>{{__('add.brand')}}</th><td> {{$asset->brand}} </td></tr>
                 <tr><th>{{__('add.interest')}}</th><td>  {{$asset->interest}} </td></tr>
                 <tr><th>{{__('add.yearlinc')}}</th><td>  {{$asset->revenue}} </td></tr>
                <tr><th>{{__('add.yearlcost')}}</th><td>  {{$asset->costs}} </td></tr>
                 <tr><th>{{__('add.purchasedate')}}</th><td> {{$asset->purchasedate}} </td></tr>
                 <tr><th>{{__('add.enddate')}} </th><td> {{$asset->enddate}} </td></tr>
                 <tr><th>{{__('add.purchaseprice')}} </th><td> {{$asset->initialinvestment}} </td></tr>
                

             @endif

              @if($asset->document->count()!='0')
              <tr><th>{{__('add.docs')}}
              </th><td><ul>
                
               
                @foreach($asset->document as $assetdocument)
                <li>
                  <a  target="_blank" rel="noopener noreferrer" href="{{asset('documents')}}/{{$assetdocument->path}}">
                {{$assetdocument->name}}
               
              </a>
              </li>
              @endforeach
 

                </ul>


              </td></tr>
              @endif 


               @if($asset->contract->count()!='0')
             <tr><th>Vertäge</th><td>


                                  <ul>
                                    @foreach($asset->contract as $assetcontract)
                                    <li><a  href="#" data-toggle="modal" data-target="#contractmodalid{{$assetcontract->id}}">{{$assetcontract->name}}</a></li>
                                    @endforeach
                                  </ul> 

            </td></tr>
                @endif 

                <th>{{__('add.notes')}}</th>
              <td><small>{{$asset->notes}}</small> </td>
            </tr>
        

                        


            @if($asset->photo->count()!='0')
             <tr><th>{{__('add.photos')}}</th><td>


                                  <ul>
                                    @foreach($asset->photo as $assetfoto)
                                    <li><a target="_blank" rel="noopener noreferrer" href="{{asset('photos')}}/{{$assetfoto->path}}">{{$assetfoto->path}}</a></li>
                                    @endforeach
                                  </ul> 

            </td></tr>
           @endif 
             

             
        </table>

        </table>
    </div> 


    @if(isset($asset->photo[0]))

    <div class="col-md-6">

         
          <div class="row">
          @foreach ($asset->photo as $assetphoto)
          <img src="{{asset('photos')}}/{{$assetphoto->path}}" class="img-thumbnail rounded" alt="Responsive image">
          @endforeach
          </div>
          

    </div>
    @endif



</div>

@if ($asset->immo)
{{$asset->immo->street}}



  <form class="form-style-7" method="POST" action="{{action('AssetController@store')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <ul>

            <li>
                <label for="name">{{__('add.adress')}}</label>
                <input type="text" name="name" maxlength="100">
                <span>Enter the street</span>
            </li>

            <li>
                <label for="name">Wert dunno what</label>
                <input type="number" name="value" maxlength="100">
                <span>Enter the Value</span>
            </li>


            <li>
               <input type="submit" class="btn btn-primary">
            </li>
           
            </ul>
        </form>

        @endif




@foreach($asset->contract as $assetcontract)
<div class="modal fade" id="contractmodalid{{$assetcontract->id}}" tabindex="-1" role="dialog" aria-labelledby="adddocumentTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="adddocumentTitle"> <a href="../{{('contracts')}}/{{$assetcontract->path}}" target="_blank"> {{$assetcontract->name}}</a></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
         <ul class="list-group">
            @foreach($assetcontract->partner as $assetcontractpartner)
         <li class="list-group-item"> Partner: <a href="{{route('partner.show',$assetcontractpartner->id)}}">{{$assetcontractpartner->name}} </a></li>
            @endforeach       
        
        

     
         <li class="list-group-item">{{__('add.stored')}}:  {{$assetcontract->storedlocation}}</li>
        <li class="list-group-item">{{__('add.agreementdate')}}: {{date("d.m.Y",$assetcontract->agreedon)}}</li>
       <li class="list-group-item">{{__('add.term')}}: {{date("d.m.Y",$assetcontract->termination)}}</li>

        @if(isset($assetcontract->reminderreg)) <li class="list-group-item">{{__('add.regremind')}}:   {{$assetcontract->reminderreg}}. {{__('add.eachmonth')}} </li>@else
     <li class="list-group-item">{{__('add.noregremind')}}: @endif
        @if (is_numeric($assetcontract->reminderterm)) <li class="list-group-item">{{__('add.lastremind')}}{{date("d.m.Y",$assetcontract->termination-$assetcontract->reminderterm*86400)}} (<small>  {{$assetcontract->reminderterm}} {{__('add.priorto')}}) </small></li>@else
        <li class="list-group-item"> {{__('add.remindnone')}}{{__('add.lastremind')}}   </small></li> @endif
          <li class="list-group-item"> <object type="application/pdf" data="{{asset('contracts')}}/{{$assetcontract->path}}"></object>
              
      </li>
    </ul>
        </div>
     
      
       </div>

    </div>
  </div>
</div>
</div>
@endforeach






@endsection
