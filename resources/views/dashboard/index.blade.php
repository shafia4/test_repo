@extends('layouts.app')
@extends('layouts.navbar')

@section('content')
<div class="container">
  

 @guest
        <h1>Welcome to white.App</h1>

        <p>white is a new form of savely storing your personal files</p>

        <h3>this is a landing page</h3>

 @else

 <h3>
  @if(date('H')<5) Gute Nacht, 
 @elseif(date('H')<11) Guten Morgen, 
 @elseif(date('H')<14) Schönen Mittag, 
   @elseif(date('H')<18) Schönen Nachmittag, 
    @elseif(date('H')<25) Schönen Abend, @endif
  {{Auth::user()->name}}</h3>
 <small>Vermögen:{{number_format($assetvalue,0,0,'.')}} {{Auth::user()->currency->name}} </small>
 <small>Nettovermögen:  {{number_format($assetvalue-$liabvalue,0,0,'.')}} {{Auth::user()->currency->name}}</small>

 @if(isset($contracts))
 <h5>Heute Fällige Vertragserinnerungen:</h5>
 <ul>
 @foreach($contracts as $contract)
 <li>
 <a href="{{route('asset.show',$contract->asset_id)}}"> 
  {{$contract->name}}</a>
 </li>
 @endforeach
 </ul>
 @endif

 

            <div class="row" style="margin-top: 3rem;">
          
            <div class="col">
                <div class="card-body" style="background-color:white">
                    <h5 class="card-title">Vermögen</h5>
                    <p class="card-text">Anzahl: {{Auth::user()->asset->count()}}</p>
                    <p class="card-text">Wert:  {{number_format($assetvalue,0,0,'.')}} {{Auth::user()->currency->name}}</p>
                     <p class="card-text"> Wertvollstes Asset: <a href="{{route('asset.show',$keyasset->id)}}">{{$keyasset->name}} </a> <small>{{max($values)}} {{Auth::user()->currency->name}}</small>

                     </p>
                     <p>Zuletzt Aktualisiert: <a href="{{route('asset.show',$lastasset->id)}}">{{$lastasset->name}}</a> <small>{{$lastasset->updated_at->DiffForHumans()}}</small></p>
                     <p>Auslaufender Vertrag  für <a href="{{route('asset.show',$keycontract->asset->id)}}">{{$keycontract->asset->name}}</a>, namentlich {{$keycontract->name}}

                     in {{$nextreminder/60/60/24}} Tagen
                 </p>
                 <p>Geschätztes passives Einkommen {{$income}} {{Auth::user()->currency->name}} pro Jahr</p>
                    <a href="{{route('asset.index')}}" class="btn btn-primary">Show All Assets</a>
                </div>
            </div>
            
              <div class="col">   

                 <div class="card-body">
                    <h5 class="card-title">Schulden</h5>
                    <p class="card-text">Anzahl: {{Auth::user()->liability->count()}}</p>
                    <p class="card-text">Wert:  {{number_format($liabvalue,0,0,'.')}} {{Auth::user()->currency->name}}</p>
                    <a href="#" class="btn btn-primary">Show All Liabilities</a>
                  </div>
              </div>
              
              
              </div>



                 

               @foreach(Auth::user()->liability as $userliability ) 
               {{$userliability->currency->name}}
              @endforeach 

               

                @endguest

                </div>




        </div>
 
@endsection
