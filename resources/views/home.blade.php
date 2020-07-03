@extends('layouts.app')
@extends('layouts.navbar')



@section('content')
<div class="container">


  @guest
  <h1>Welcome to white.App</h1>

  <p>white is a new form of savely storing your personal files</p>

  <h3>this is a landing page</h3>

  @else
  <div class="row">


    <div class="col-md-6">
      <h2>
        @if(date('H')<5) {{__('home.gn')}} @elseif(date('H')<11) {{__('home.gm')}} @elseif(date('H')<14) {{__('home.gm')}} @elseif(date('H')<18) {{__('home.ga')}} @elseif(date('H')<25) {{__('home.ne')}} @endif {{Auth::user()->name}}</h2> </div> </div> <small style="color:lightgrey"><?php echo (md5(Auth::user()->id));
                                                                                                                                                                                                                                                                                            echo (md5(now())) ?></small>

          <hr>


          @if($inhereracessed!=[])

          @foreach($inhereracessed as $inhereracess)

          @if(strToTime(now())<$inhereracess->acessed+$inhereracess->inherer[0]->graceperiod)

            <div class="alert alert-warning" role="alert">

              {{$inhereracess->inherer[0]->name}} {{__('home.registered')}} {{date('m/d/Y',$inhereracess->acessed)}} {{__('home.credentials')}} {{date('m/d/Y',$inhereracess->acessed+$inhereracess->inherer[0]->graceperiod)}} {{__('home.at')}} {{date('h:m',$inhereracess->acessed+$inhereracess->inherer[0]->graceperiod)}}.
              @if($inhereracess->inherer[0]->is_active==1)
              {{__('home.preventactive')}}
              @else
              {{$inhereracess->inherer[0]->name}} {{__('home.preventinactive')}}
              @endif


              <p>
                <a href="{{route('inherer.index')}}"> </a></p>
            </div>

            @elseif(strToTime(now())>$inhereracess->acessed+$inhereracess->inherer[0]->graceperiod)

            <div class="alert alert-danger" role="alert">

              {{$inhereracess->inherer[0]->name}} {{__('home.registered')}} {{date('m/d/Y',$inhereracess->acessed)}} {{__('home.credentials')}} {{date('m/d/Y',$inhereracess->acessed+$inhereracess->inherer[0]->graceperiod)}} {{__('home.at')}} {{date('h:m',$inhereracess->acessed+$inhereracess->inherer[0]->graceperiod)}} .

              @if($inhereracess->inherer[0]->is_active==1)
              {{__('home.preventactive')}}
              @else
              {{$inhereracess->inherer[0]->name}} {{__('home.preventinactive')}}
              @endif


              <p>
                <a href="{{route('inherer.index')}}"> <input type="submit" value="{{__('home.edit')}}" class="btn btn-xs btn-outline-primary btn-sm"></input></a></p>


            </div>
            @endif
            @endforeach
            @endif

            <div class="row">
              <div class="col-md-6">
                <h3>


                  @if(($assetvalue-$liabvalue)>0)
                  <h1> {{__('home.totalwealth')}}: <span class="badge badge-success" style="background-color: #80002a"> {{number_format($assetvalue-$liabvalue,0,0,'.')}} {{isset(Auth::user()->currency) ? Auth::user()->currency->name : ''}}</span></h1>
                  @else
                  {{__('home.totalwealthneg')}}:
                  <span class="badge badge-danger"> {{number_format($assetvalue-$liabvalue,0,0,'.')}} {{isset(Auth::user()->currency) ? Auth::user()->currency->name : ''}}</span>

                  @endif
                </h3>
                <h5>
                  <ul>
                    <li>{{__('home.totalassets')}}: {{number_format($assetvalue,0,0,'.')}} {{isset(Auth::user()->currency) ? Auth::user()->currency->name : ''}}</li>
                    <li> {{__('home.totalliabilities')}}: {{number_format($liabvalue,0,0,'.')}} {{isset(Auth::user()->currency) ? Auth::user()->currency->name : ''}}</li>
                    <li> {{__('home.profitability')}}: {{$assetvalue != 0 ? number_format(($income-$userinterest)/$assetvalue,3)*100 : 0}} %</li>

                  </ul>

                </h5>
              </div>


              <div class="col-md-4" style="background-color: rgb(224, 88, 66,0.1)">

                <small>
                  {{__('add.news')}}
                  <ul>
                    @if(rand(1,5)<2) @foreach($cash as $cas) <li>{{__('home.valueok')}} <a href="{{route('asset.show',$cas->id)}}}}">{{$cas->name}}</a> , {{$cas->value}}{{isset($cas->currency) ? $cas->currency->name : ''}}
                      {{__('home.valueok1')}} {{$cas->updated_at->diffForHumans()}} </li>
                      @endforeach
                      @endif

                      @foreach(Auth::user()->asset as $userasset)


                      @foreach($userasset->contract as $userassetcontract)

                      @if($userassetcontract->termination-strToTime(now())>0 and ($userassetcontract->termination-strToTime(now()))/3600/24<14) <li> <a href="{{route('asset.show',$userassetcontract->asset->id)}}">{{$userassetcontract->name}} </a> {{__('home.terminate')}} {{number_format(($userassetcontract->termination-strToTime(now()))/3600/24+1,0,0,'.')}} {{__('home.terminate1')}} </li>

                        @endif

                        @endforeach
                        @endforeach
                        @if(rand(1,5)<2) <li>{{__('home.inherer')}} {{Auth::user()->inherer->count()}} {{__('home.inherer1')}} {{Auth::user()->inherer->where('is_active',1)->count()}} {{__('home.inherer2')}} <a href="{{route('inherer.index')}}">{{__('home.inherer3')}} </a></li>
                          @endif
                  </ul>

                </small>

              </div>
            </div>

            <hr>





            <div class="row">
              <div class="col-md-4">
                <p>{{__('home.totalwealthandliab')}}</p>

                <div> <canvas id="totalwealth" width="50" height="150"></canvas></div>
              </div>

              <div class="col-md-4 ">
                <p>{{__('home.capitalprof')}} </p>



                <div> <canvas id="passive" width="150" height="150"></canvas></div>
              </div>

              <div class="col-md-4">
                <p>{{__('home.assetclasses')}}</p>
                <div><canvas id="byform" width="50" height="150"></canvas></div>
              </div>

            </div>

    </div>


    <hr>








    <!-- @if(($contracts)!=[])
 <h5>Nächste Vertragserinnerungen:</h5>
 {{$contracts}}
 <ul>
 @foreach($contracts as $contract)
 <li>
 <a href="{{route('asset.show',$contract->asset_id)}}"> 
  {{$contract->name}}</a>
 </li>
 @endforeach
 </ul>
 @endif
 -->




    <div class="row" style="margin-top: 3rem;">

      <div class="col">
        <div class="card-body" style="background-color: rgb(224, 88, 66,0.3); border-radius:10px">
          <h5 class="card-title">{{__('home.asset')}}</h5>
          @if(Auth::user()->asset->count()>0)

          <ul class="list-group">
            <li class="list-group-item">{{__('home.number')}}: {{Auth::user()->asset->count()}}</li>
            <li class="list-group-item">{{__('home.value')}}: {{number_format($assetvalue,0,0,'.')}} {{isset(Auth::user()->currency) ? Auth::user()->currency->name : ''}}</li>
            <li class="list-group-item"> {{__('home.mostvalu')}}: <a href="{{route('asset.show',$keyassetid)}}">{{$keyasset[0]['name']}} </a> <small>{{max($values)}} {{isset(Auth::user()->currency) ? Auth::user()->currency->name : ''}}</small>
            </li>
            <li class="list-group-item">{{__('home.lastmod')}}: <a href="{{route('asset.show',$lastasset->id)}}">{{$lastasset->name}}</a> <small>{{$lastasset->updated_at->DiffForHumans()}}</small></li>
            <li class="list-group-item">{{__('home.passivincome')}} : {{number_format($income,0,0,'.')}} {{isset(Auth::user()->currency) ? Auth::user()->currency->name : ''}} {{__('home.pery')}} </small></li>
            <li class="list-group-item">{{__('home.incomeinpct')}} : {{number_format($income/$assetvalue,3)*100}} % </li>

          </ul>
          <br>
          <a href="{{route('asset.index')}}" class="btn btn-primary">{{__('home.showass')}}</a>
          @else
          <p class="card-text">{{__('home.noass')}}t</p>
          <a href="{{route('asset.create')}}" class="btn btn-primary">{{__('home.startadd')}}</a>
          @endif


        </div>
      </div>

      <div class="col">

        <div class="card-body" style="background-color: rgb(224, 88, 66,0.1); border-radius:10px">
          <h5 class="card-title">{{__('home.liabilities')}}</h5>
          @if(Auth::user()->liability->count()>0)
          <ul class="list-group">
            <li class="list-group-item">{{__('home.number')}}: {{Auth::user()->liability->count()}}</li>
            <li class="list-group-item">{{__('home.value')}}: {{number_format($liabvalue,0,0,'.')}} {{isset(Auth::user()->currency) ? Auth::user()->currency->name : ''}}</li>
            <li class="list-group-item">{{__('home.mostliab')}}: <a href="{{route('liability.show',$keyliabid)}}">{{$keyliab[0]['name']}} </a> <small>{{max($valuesl)}} {{isset(Auth::user()->currency) ? Auth::user()->currency->name : ''}} </small></li>
            <li class="list-group-item">{{__('home.lastmod')}}: <a href="{{route('liability.show',$lastliab->id)}}">{{$lastliab->name}}</a> <small>{{$lastliab->updated_at->DiffForHumans()}}</small></li>
            <li class="list-group-item">{{__('home.interestpaid')}} {{number_format($userinterest,0,0,'.')}} {{isset(Auth::user()->currency) ? Auth::user()->currency->name : ''}} </li>
            <li class="list-group-item">{{__('home.avginterest')}} : {{number_format($userinterest/$liabvalue,4)*100}} %</li>

          </ul>
          <br>

          <a href="{{route('liability.index')}}" class="btn btn-primary">{{__('home.showliab')}}</a>
          @else
          <p class="card-text">{{__('home.noliab')}}</p>
          <a href="{{route('liability.create')}}" class="btn btn-primary">{{__('home.startaddl')}}</a>
          @endif

        </div>
      </div>


    </div>
    <div class="row" style="margin-top: 3rem;">

      <div class="col">


        <div class="card-body" style="background-color:#fce6e8; border-radius:10px">
          <h5 class="card-title">{{__('home.inherer')}}</h5>

          <table class="table table-hover table-striped">


            <thead>
              <tr>

                <th scope="col">{{__('settings.name')}}</th>
                <th scope="col">{{__('settings.isactive')}}?</th>
                <th scope="col">{{__('settings.grace')}}</th>

              </tr>
            </thead>

            <tbody>

              @foreach(Auth::user()->inherer as $inherer)

              <tr>
                <td>{{$inherer->name}}</td>
                <td>{{$inherer->is_active}}</td>
                <td>{{$inherer->graceperiod/24/60/60}} Tage</td>
              </tr>
            </tbody>


            @endforeach
          </table>

          <a href="{{route('inherer.index')}}" class="btn btn-primary">{{__('home.edit')}} </a>
        </div>
      </div>




      <div class="col">

        <div class="card-body" style="background-color:#80002a; color:#ffe6e6; border-radius:10px">
          <h5 class="card-title">{{__('nav.settings')}}</h5>

          <ul>
            <li>{{__('home.status')}}: {{Auth::user()->role->name}} </li>
            <li>{{__('home.member')}}: {{Auth::user()->created_at->diffForHumans()}} </li>
            <li>{{__('home.currency')}}: {{isset(Auth::user()->currency) ? Auth::user()->currency->name : ''}} </li>
            <li>{{__('home.lastcurrency')}}: {{$currencyupdate->updated_at != '' ? $currencyupdate->updated_at->diffForHumans() : ''}}</li>

          </ul>
          <a href="{{route('user.edit', Auth::user()->id)}}" class="btn btn-primary">{{__('home.edit')}} </a>
        </div>
      </div>
    </div>
    @endguest

  </div>




</div>


<script>
  var ctx = document.getElementById('totalwealth');
  Chart.defaults.global.legend.display = false;


  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Total Assets', 'Total Liabilities', 'Total Net Worth', ],
      datasets: [{
        label: 'in thousand',
        data: [{
          {
            number_format($assetvalue / 1000, 0, 0, '')
          }
        }, -{
          {
            number_format($liabvalue / 1000, 0, 0, '')
          }
        }, {
          {
            number_format(($assetvalue - $liabvalue) / 1000, 0, 0, '')
          }
        }],
        backgroundColor: [
          'rgba(11,156,59, 0.2)',
          'rgba(240, 52, 52, 0.2)',
          'rgba(255, 206, 86, 0.2)',

        ],
        borderColor: [
          'rgba(11,156,59,, 1)',
          'rgba(240, 52, 52, 1)',
          'rgba(255, 206, 86, 1)',

        ],
        borderWidth: 1
      }]
    },
    options: {
      maintainAspectRatio: false,

      scales: {

        xAxis: [{
          ticks: {
            beginAtZero: false,

          }

        }],

        yAxis: [{
          ticks: {
            beginAtZero: false,

          }

        }]

      }
    }
  });
</script>


<script type="text/javascript">
  Chart.defaults.global.legend.display = false;

  var form = document.getElementById('byform');


  var myChart = new Chart(form, {
    type: 'pie',
    data: {
      labels: [@foreach($assetclasses as $assetclass)
        "{{Lang::get(DB::table('assettypes')->where('id',$assetclass[0]['assettype_id'])->value('name'))}}", @endforeach
      ],
      datasets: [{
        label: 'in thousand',
        data: [@foreach($assetclasses as $assetclass) {
          {
            number_format(($assetclass - > sum('value') / $assetvalue) * 100, 0, 0, '')
          }
        }, @endforeach],
        backgroundColor: [
          @foreach($assetclasses as $assetclass)
          '{{$color[rand(0,14)]}}', @endforeach



        ],
        borderColor: [
          @foreach($assetclasses as $assetclass)
          '{{$bordercolor[rand(0,14)]}}', @endforeach

        ],
        borderWidth: 1
      }]
    },
    options: {
      maintainAspectRatio: false,

      scales: {

        xAxis: [{

          ticks: {
            display: false,
            beginAtZero: false,

          }

        }],

        yAxis: [{
          ticks: {
            display: false,
            beginAtZero: false,


          }

        }]

      }
    }
  });
</script>

<script>
  var pass = document.getElementById('passive');
  Chart.defaults.global.legend.display = false;


  var myChart = new Chart(pass, {
    type: 'bar',
    data: {
      labels: ['Passive income', 'Interest payable', @if($income - $userinterest > 0)
        'Capital Gains'
        @else 'Capital Loss'
        @endif
      ],
      datasets: [{
        label: 'in thousand',
        data: [{
          {
            number_format($income / 1000, 0, 0, '')
          }
        }, -{
          {
            number_format($userinterest / 1000, 0, 0, '')
          }
        }, {
          {
            number_format(($income - $userinterest) / 1000, 0, 0, '')
          }
        }],
        backgroundColor: [
          'rgba(11,156,59, 0.2)',
          'rgba(240, 52, 52, 0.2)',
          'rgba(255, 206, 86, 0.2)',

        ],
        borderColor: [
          'rgba(11,156,59,, 1)',
          'rgba(240, 52, 52, 1)',
          'rgba(255, 206, 86, 1)',

        ],
        borderWidth: 1
      }]
    },
    options: {
      maintainAspectRatio: false,

      scales: {

        xAxis: [{
          ticks: {
            beginAtZero: false,

          }

        }],

        yAxis: [{
          ticks: {
            beginAtZero: false,

          }

        }]

      }
    }
  });
</script>

@endsection
