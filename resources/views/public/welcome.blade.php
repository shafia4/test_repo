<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="white APP ist the place to safely store information on your (unphyisical) Assets and Liabilities. For you and those after you.">

    <title>WhiteAPP </title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Lato|Source+Sans+Pro&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="app.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,600" rel="stylesheet" type="text/css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-170819825-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-170819825-1');
    </script>

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-NQ48KCJ');
    </script>
    <!-- End Google Tag Manager -->





    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;

            body {
                font-family: 'Lato', sans-serif;
                font-family: 'Source Sans Pro', sans-serif;
                background-color: #FFFFFF
            }
        }

        .btn-landing1 {
            background-color: #E05842;
            border: none;
            color: white;
            padding: 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 4px 2px;
            border-radius: 8px;
        }

        .btn-landing2 {
            background-color: white;
            border: none;
            color: #636b6f;
            padding: 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 4px 2px;
            border-radius: 8px;
        }

        .btn-landing3 {
            background-color: #E05842;
            border: none;
            color: white;
            padding: 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 2px22px;
            border-radius: 6px;
        }



        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .top-left {
            position: absolute;
            left: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        a {
            color: #E05842;
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            padding-top: 0;
            height: 0;
            overflow: hidden;
        }

        .video-container iframe,
        .video-container object,
        .video-container embed {
            position: absolute;
            top: 20%;
            left: 20%;
            width: 60%;
            height: 60%;
        }
    </style>
</head>

<body>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NQ48KCJ" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->




    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravelll') }} <small>v 0.0.1</small>
        </a>

        @if (Route::has('login'))

        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">

                @auth
            <li class="nav-item active" style="margin-right: 5px;border-right: 1px solid silver" <a href="www.twitter.com">{{__('nav.follow')}} *</a>
            </li>
            <li class="nav-item active"> <a href="https://trello.com/b/q8si76t7/whiteapp-changelog" target="_blank"> Changelog</a> </li>
            @else


            <li class="nav-item active" style="margin-right: 5px;border-right: 1px solid silver" <a href="www.twitter.com">{{__('nav.follow')}} *</a>
            </li>
            <li class="nav-item active"> <a href="https://trello.com/b/8CWJP189/whitedev"> Changelog</a> </li>
            @endauth


            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            @auth
            <li class="nav-item active"> <a href="{{ url('/home') }}"><button class="btn-sm btn-landing3">{{__('nav.gotoapp')}}</button></a></li>
            <li> ---- </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}"> <button class="btn-landing1 links"> Login</button></a>
                    </li>
                    <a href="{{ route('register') }}"><button class="btn-landing2 links">Register</button></a>
                    @endauth
                </ul>
                </div>
                @endif
            </li>
        </ul>
    </nav>

    <div class="flex-center position-ref full-height bg-light">

        <div class="content">
            <!--  <div class="title m-b-md">
                            <h3>white.APP</h3>
                            <h5>{{__('landing.welcome_msg')}}</h5>
                </div>

                <div class="links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                        <a href="{{route('inherer.get')}}">Als Erbe anmelden</a>
                        <a href="#landingpage">Landingpage</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                         <a href="#landingpage">Landingpage</a>
                         <a href="#Erbe">Erbe?</a>
                         <a href="{{route('inherer.get')}}">Als Erbe anmelden</a>
                    @endauth
                </div> -->


            <div class="row">
                <div class="col-md-5 ">

                    <br><br><br><br>
                    <div class="title m-b-md" style="padding-top:140px">

                        <h3>
                            <p class="font-weight-bold">{{__('landing.welcome_msg')}} </p>
                        </h3>
                        <h5>{{__('landing.slogan')}}</h5>


                    </div>
                    @Auth

                    <a href="{{ url('/home') }}"> <button class="btn-landing1">{{__('landing.gotoapp')}}</button> </a>
                    @else

                    <a href="{{ route('register') }}"><button class="btn-landing1">{{__('landing.createaccount')}}</button> </a> {{__('landing.free90')}}
                    @endauth
                </div>


                <div class="col-md-7" style="padding-left:50px"> <img class="img-fluid rounded" src="{{ URL::to('/img/landing3.png') }}"></div>


            </div>

        </div>
    </div>
    <hr>
    <div style="text-align: center">
        <h3>{{__('landing.join')}}</h3>
    </div>
    <hr>
    <div class="" id="landingpage" style="background-color:#E05842; color:white; text-align:center; min-height:100%">

        <h2 style="padding-top:50px">{{__('landing.features')}}</h2>

        <div class="row">
            <div class='col-md-4' style="padding:50px 50px 50px 50px">
                <p style="text-align:center"><i class="fas fa-mobile-alt fa-2x"></i></p>
                <br>
                <h3> {{__('landing.feature1heading')}}</h3>
                <hr>
                {{__('landing.feature1')}}
            </div>
            <div class='col-md-4' style="padding:50px 50px 50px 50px">
                <p><i class="fas fa-file-signature fa-2x"></i></p>
                <br>
                <h3> {{__('landing.feature2heading')}}</h3>
                <hr> {{__('landing.feature2')}}
            </div>
            <div class='col-md-4' style="padding:50px 50px 50px 50px">
                <p> <i class="fas fa-lock fa-2x"></i></p>
                <br>
                <h3> {{__('landing.feature3heading')}}</h3>
                <hr> {{__('landing.feature3')}}
            </div>
        </div>
        <hr>
        <br><br>

        <div class="row">
            <div class='col-md-4' style="padding:50px 50px 50px 50px">
                <p style="text-align:center"><i class="fas fa-balance-scale fa-2x"></i></p>
                <br>
                <h3> {{__('landing.feature4heading')}}</h3>
                <hr>
                {{__('landing.feature4')}}
            </div>
            <div class='col-md-4' style="padding:50px 50px 50px 50px">
                <p><i class="fas fa-coffee fa-2x"></i></p>
                <br>
                <h3> {{__('landing.feature5heading')}}</h3>
                <hr> {{__('landing.feature5')}}
            </div>
            <div class='col-md-4' style="padding:50px 50px 50px 50px">
                <p> <i class="fab fa-btc fa-2x"></i></p>
                <br>
                <h3> {{__('landing.feature6heading')}}</h3>
                <hr> {{__('landing.feature6')}}
            </div>
        </div>


    </div>
    <div style="text-align: center">
        <h3></h3>
    </div>
    <div class="" id="Erbe" style="background-color:white; color:#E05842; text-align:center; ">
        <div class="row">
            <div class='col-md-6'>
                <div style="padding-top: 150px; padding-left:50px">
                    <p>{{__('landing.art')}}</p> <br>
                    <p>
                        <h3>{{__('landing.art1')}}</h3>
                    </p>
                </div>
            </div>
            <div class='col-md-6'>
                <div><img class="img-fluid img-xs rounded" src="{{ URL::to('/img/art.jpg') }}"> </div>
            </div>
        </div>

        <div class="row">
            <div class='col-md-6' style="">
                <img class="img-fluid  img-xs rounded" src="{{ URL::to('/img/hausrazanac.jpg') }}">
            </div>
            <div class='col-md-6'>
                <div style="padding-top: 150px; padding-right:50px">
                    <p>{{__('landing.realestate')}}</p> <br>
                    <p>
                        <h3>{{__('landing.realestate1')}}</h3>
                    </p>
                </div>
            </div>
        </div>


        <div class="row">
            <div class='col-md-6' style="">
                <div style="padding-top: 150px; padding-left:50px">
                    <p>{{__('landing.watch')}}</p> <br>
                    <p>
                        <h3>{{__('landing.watch1')}}</h3>
                    </p>
                </div>
            </div>
            <div class='col-md-6' style="padding:50px 50px 50px 50px"> <img class="img-fluid img-xs rounded" src="{{ URL::to('/img/uhr.jpg') }}"> </div>
        </div>

    </div>

    <div id="explainervideo" style="text-align:center; background-color:#E05842">

        <div class="video-container">


            <iframe width="560" height="315" src="https://www.youtube.com/embed/xJlvtquvbDY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

        </div>

    </div>



    <div class="full-height" id="moscow" style="background-image: url(/img/altedonau.jpg) ; min-width: 100% min-height: 100%; background-color: #cccccc;color:white; text-align:center;background-repeat:no-repeat;  background-size: 100% 120%; ">

        <h2 style="padding:250px">{{__('landing.madein')}}</h2>



    </div>

    @include('layouts.footer')

    <link rel="stylesheet" type="text/css" href="https://cdn.wpcc.io/lib/1.0.2/cookieconsent.min.css" />
    <script src="https://cdn.wpcc.io/lib/1.0.2/cookieconsent.min.js"></script>
    <script>
        window.addEventListener("load", function() {
            window.wpcc.init({
                "border": "thin",
                "corners": "small",
                "colors": {
                    "popup": {
                        "background": "#ffe4e1",
                        "text": "#000000",
                        "border": "#c25e5e"
                    },
                    "button": {
                        "background": "#c25e5e",
                        "text": "#ffffff"
                    }
                },
                "position": "top",
                "content": {
                    "href": "./dataprotection"
                }
            })
        });
    </script>
</body>



</html>
