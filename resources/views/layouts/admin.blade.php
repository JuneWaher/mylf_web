<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
   
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body style="background-image: url('{{asset('/uploads/style/skulls.png')}}');">
    <div id="app">
        <nav class="navbar navbar-default navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-left">
                        <li class="nav-item"><a href="{{ url('admin/articles') }}" class="nav-link">Articles</a>
                        </li>
                        <li class="nav-item"><a href="{{ url('admin/games') }}" class="nav-link">Games</a>
                        </li>
                        <li class="nav-item"><a href="{{ url('admin/members') }}" class="nav-link">Members</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="nav-item" style="background-color: white;"><a class="nav-link active">Admin-Board</a></li>
                            <li class="nav-item" style="background-color: white;"><a href="{{ route('home')}}" class="nav-link active">Retour au Site</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {!! Html::image('uploads/avatars/'.Auth::user()->avatar, 'avatar', array('style' => 'width:20px;height:20px;border-radius:50%;')) !!} {{ Auth::user()->name }}
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ url('/profile') }}">
                                            <i class="fa fa-btn fa-user-circle"> Profile</i>
                                        </a>
                                    </li>
                                    @if (Auth::user()->isRole('admin'))
                                        <li>
                                            <a href="{{ url('/admin') }}">
                                                <i class="fa fa-btn fa-beer"> Admin</i>
                                            </a>
                                        </li>
                                    @endif
                                    @if (Auth::user()->isRole('admin'))
                                        <li>
                                            <a href="{{ url('/article/create') }}">
                                                <i class="fa fa-btn fa-pencil"> Articles</i>
                                            </a>
                                        </li>
                                    @endif
                                    @if (Auth::user()->isRole('admin'))
                                        <li>
                                            <a href="{{ url('/game/create') }}">
                                                <i class="fa fa-btn fa-coffee"> Games</i>
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-btn fa-sign-out"> Logout</i>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @if (session()->has('ok'))
            <div class="container">
            <div class="alert alert-success alert-dismissible fade show">{!! session('ok') !!}</div>
            </div>
        @endif
        @yield('content')
        <div style="height: 5%;padding-bottom: 10%"></div>
        <div class="footer navbar-inverse navbar-fixed-bottom" style="font-size:0.8em;border-top:5px solid CornflowerBlue;background-color: black;">
        <i class="pull-left text-left text-info">Discord - Facebook - E-Mail</i>
            <p class="text-right text-info pull-right">Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by Myrrdin</p>
        </div>
    </div>
    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>