<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @section('title')
            Laravel App
        @show
    </title>


    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ URL::to('/') }}/css/magnific-popup.css" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::to('/') }}/css/magnific-popup-all.min.css" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('css/style.css') !!}" rel="stylesheet" type="text/css"/>

    @yield('topcss')

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>

    @yield('topcss')
</head>
<body id="app-layout" class="logged_{{ Auth::guest() ? 'out' : 'in' }}">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            
            <div class="navbar-header">
                @if (Auth::check())
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding -->
                    <a class="navbar-brand branding" href="{{ url('/') }}">
                        <div><b>LaraPosts</b> The custom laravel application for teamupdivision.</div>
                    </a>
                @endif
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                @unless (Auth::guest())
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown logged_in_user">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="fa fa-user btn-xs"></span> {{ Auth::user()->name() }}
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/user/'.Auth::user()->id) }}"><i class="fa fa-btn fa-pencil-square-o"></i>Edit Profile</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                         
                        </li>
                        <li class="dashboard_links">
                            @unless (Auth::user()->isPublisher())
                                <a href="{{ url('/user') }}" class="dashboard_link {{ Request::path() == 'home' ? 'active' : '' }}" role="button" aria-expanded="false">
                                    <span class="fa fa-users btn-xs"></span> Users
                                </a>
                            @endunless

                                 <a href="{{ url('/post') }}" class="dashboard_link {{ Request::path() == 'home' ? 'active' : '' }}" role="button" aria-expanded="false">
                                    <span class="fa fa-sticky-note"></span> Posts
                                </a>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    @yield('endjs')
</body>
</html>
