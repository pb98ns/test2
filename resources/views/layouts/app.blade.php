<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>System czasu pracy</title>
   
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  @stack('scripts')
<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('front/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/custom.css') }}" rel="stylesheet">
    
  <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
@yield('css')
</head>
<body>
    
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-secondary shadow-sm ">
            <div class="container" >
            
            
                <a class="navbar-brand ml-auto" href="{{ url('/home') }}" >
              
                   <img text-align="center" src="{{URL::asset('clock-10-512.png')}}"  width="23" height="23" alt="" >

                
                   
                </a>
              
                
                
                <button class="navbar-toggler ml-auto" style="margin: auto;" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon" display= "table"></span>
  </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                </ul>

                    <!-- Center Side Of Navbar -->
                   
                <ul class="nav justify-content-end">
                <ul class="navbar-nav mx-auto ">
                        <!-- Authentication Links -->
                        @guest
                   
                        @else
     
                        @if(Auth::User()->permissions == 'Administrator')
                        <li class="nav-item active">
                <a class="nav-link px-4" href="{{ url('register') }}">
                {{ __('Użytkownicy') }}
                </a>
                </li>
                @endif
                        @if(Auth::User()->permissions == 'Administrator')
                        <li class="nav-item active">
                <a class="nav-link px-4" href="{{ url('home/customers') }}">
                {{ __('Klienci') }}
                </a>
                </li>
                @endif
                @if(Auth::User()->permissions == 'Administrator')
                <li class="nav-item active">
                <a class="nav-link px-4" href="{{ url('home/tasks') }}">
                {{ __('Projekty') }}
                </a>
                </li>
                @endif
                @if(Auth::User()->permissions == 'Administrator')
                <li class="nav-item active">
                <a class="nav-link px-4" href="{{ url('home/vacations') }}">
                {{ __('Urlopy') }}
                </a>
                </li>
                @endif
                @if(Auth::User()->permissions == 'Użytkownik')
                <li class="nav-item active">
                <a class="nav-link px-4" href="{{ url('home') }}">
                {{ __('Raporty') }}
                </a>
                </li>
                @endif
                @if(Auth::User()->permissions == 'Użytkownik')
                <li class="nav-item active">
                <a class="nav-link px-4" href="{{ url('home/vacations') }}">
                {{ __('Urlopy') }}
                </a>
                </li>
                @endif
                @if(Auth::User()->permissions == 'Administrator')
                <li class="nav-item active">
                <a class="nav-link px-4" href="{{ url('home/reports') }}">
                {{ __('Raporty') }}
                </a>
                </li>
                @endif
                @if(Auth::User()->permissions == 'Administrator')
                <li class="nav-item active">
                <a class="nav-link px-4" href="{{ url('home/day_reports') }}">
                {{ __('Raport dzienny') }}
                </a>
                </li>
                @endif
                @if(Auth::User()->permissions == 'Administrator')
                <li class="nav-item active">
                <a class="nav-link px-4" href="{{ url('home/period_reports') }}">
                {{ __('Raport okresowy') }}
                </a>
                </li>
                @endif
                @if(Auth::User()->permissions == 'Administrator')
                <li class="nav-item active">
                <a class="nav-link px-4" href="{{ url('home/vacations_reports') }}">
                {{ __('Raport urlopowy') }}
                </a>
                </li>
                @endif
                   
                    

               
                <li class="nav-item dropdown ">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle px-4" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}  {{ Auth::user()->surname }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-center" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Wyloguj się') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
  </ul>
  </ul>
            </div>
            
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
