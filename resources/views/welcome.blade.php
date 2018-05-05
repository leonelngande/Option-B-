@push('css-home')
    <link rel="stylesheet" href="{{ URL::asset('css/home.css')}}">
@endpush

@extends('layouts.app')

@section('head_title', 'Home |' )

@section('content')
<div>
    <div class="container">
    @if(Auth::guest())
    <form id="signin" class="navbar-form navbar-right" role="form" method="POST" action="{{url('/login')}}">
        {{ csrf_field() }}
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="email" type="text" class="form-control" name="username" value="" placeholder="Username">                                        
        </div>

        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="password" type="password" class="form-control" name="password" value="" placeholder="Password">                                        
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    @endif
    </div>

    <!--<div class="flex-center position-ref full-height">

        <div class="content">
            <div class="title m-b-md">
                Option B+
            </div>

            <div class="links">
                <a href="">Bamenda General Hospital</a>
            </div>
        </div>
    </div>-->
    
</div>

<div class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>Option B+</h1>
                        <h3>A computerised system for managing consultation, drugs distribution, and appointments for HIV patients.</h3>
                        <hr class="intro-divider">
                        <ul class="list-inline intro-social-buttons">
                            <li>
                                <a href="{{ route('patient-list') }}" class="btn btn-default btn-lg"> <span class="network-name">View Patient List</span></a>
                            </li>
                            <li>
                                <a href="{{ route('appointment-list') }}" class="btn btn-default btn-lg"> <span class="network-name">Today's Appointment</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.intro-header -->
@endsection