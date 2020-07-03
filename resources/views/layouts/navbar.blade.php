@section('navbar')





<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{ url('/') }}">
    {{ config('app.name', 'Laravelll') }} <small>v 0.0.1</small>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{route('home')}}">{{__('nav.home')}} <span class="sr-only">(current)</span></a>
      </li>

      @guest
      <li class="nav-item">
        <a class="nav-link" href="{{route('asset.index')}}">Über White.app</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../inhererget">Als Erbe Anmelden</a>
      </li>



      @else

      <li class="nav-item">
        <a class="nav-link" href="{{route('asset.index')}}">{{__('nav.wealth')}}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('liability.index')}}">{{__('nav.loans')}}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('inherer.index')}}">{{__('nav.inherer')}}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('partner.index')}}">{{__('nav.partner')}}</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <strong> {{__('nav.add')}}</strong>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{route('asset.create')}}">{{__('nav.wealth')}}</a>
          <a class="dropdown-item" href="{{route('liability.create')}}">{{__('nav.loans')}}</a>
          <a class="dropdown-item" href="{{route('partner.add')}}">{{__('nav.partner')}}</a>
          <a class="dropdown-item" href="{{route('inherer.add')}}">{{__('nav.inherer')}}</a>
          <div class="dropdown-divider"></div>

        </div>
      </li>


      <li class="nav-item">

        <a type="button" class="nav-link" data-toggle="modal" data-target="#quickAdd">QuickAdd </a>

      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{__('nav.settings')}}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          @guest

          @else
          <a class="dropdown-item" href="{{route('user.edit', Auth::user()->id)}}">{{__('nav.personal')}}</a>
          @endguest
          <a class="dropdown-item" href="#">Inherer Rules</a>
          <a class="dropdown-item" href="#">white.pro</a>
        </div>
      </li>


      @if(auth()->user()->role->name=='admin')
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbaradmin" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:green">admin</a>
        <div class="dropdown-menu" aria-labelledby="navbaradmin">
          <a class="dropdown-item" href="{{route('admin.dashboard')}}">Dashboard</a>
          <a class="dropdown-item" href="{{route('admin.currency')}}">Währung</a>
        </div>

      </li>
      @endif
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="language" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:green"> {{session('locale')}}</a>


        <div class="dropdown-menu" aria-labelledby="language">
          <a class="dropdown-item" href="../lang/de">Deutsch</a>
          <a class="dropdown-item" href="../lang/en">English</a>
        </div>


      </li>

    </ul>
    <ul class="nav navbar-nav navbar-right">
      @endguest

      <li> <small><?php

                  echo date("d.m.Y");



        ?></small></li>
      <LI> >--< </LI> <!-- Authentication Links -->
          @guest
      <li><a href="{{ route('login') }}">Login</a></li>
      <li><a href="{{ route('register') }}">Register</a></li>
      @else
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
        </ul>
      </li>
      @endguest
    </ul>
  </div>
</nav>

<div class="modal fade" id="quickAdd" tabindex="-1" role="dialog" aria-labelledby="quickAdd" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Quick add</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="name">Enter Asset/Liability and value</label>
            <input type="text" class="form-control" name="name" aria-describedby="nameHelp" placeholder="i.e. House Mar-o-lago 2500000 or Loan Erstbank 40000">
            <small id="nameHelp" class="form-text text-muted">Use our AI to add</small>
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection