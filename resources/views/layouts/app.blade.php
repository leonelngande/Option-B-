<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('head_title') {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ URL::asset('css/app.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/custom.css')}}" rel="stylesheet">

    @stack('css-home')

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">

        <div id="banner">
            <h1 class="">Bamenda General Hospital</h1>
            <hr>
        </div>

        <nav class="navbar navbar-inverse navbar-static-top">
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
                    <ul class="nav navbar-nav">
                        &nbsp;

                        <?php
                            // get the current user's details
                            $user = Auth::user();
                        ?>


                        @if (!Auth::guest())
                            <li><a href="{{ url('/') }}" class="btn btn-primary" role="button">Home</a></li>
                            
                            <li><a href="{{ route('patient-list') }}" class="btn btn-primary" role="button">Patient List</a></li>

                            @if( !empty($user) && $user->level == 'd' )
                                <li><a href="{{ route('create-patient') }}" class="btn btn-primary" role="button">Register Patient</a></li>
                            @endif

                            <li><a href="{{ route('appointment-list') }}" class="btn btn-primary" role="button">Today's Appointments</a></li>
                        @endif  
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>

                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle btn btn-danger" data-toggle="dropdown" role="button" aria-expanded="false" style="color: black;">
                                    Logged in as {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    

                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
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

        @yield('content')
    </div>

    <footer class="container-fluid bg-4 text-center">
    <p class="col-md-12"><a href="">Developed by Leonel Elimpe</a> &copy {{ date("Y") }} </p> 
    </footer>

    <!-- Scripts -->
    <script src="{{ URL::asset('js/app.js')}}"></script>
    <script src="{{ URL::asset('js/jquery-1.10.2.min.js')}}"></script>
    <script src="{{ URL::asset('js/custom.js')}}"></script>
    
</body>
</html>
