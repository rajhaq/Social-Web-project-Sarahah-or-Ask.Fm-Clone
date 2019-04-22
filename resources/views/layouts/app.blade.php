<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/compiled.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    @guest
                    @else
                    <li><a class="nav-link" href="{{ url('status/all') }}">{{ __('All Status') }}</a></li>
                    @endguest
                    
            
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="nav-item ">
                                <a class="nav-link dark-grey-text font-weight-bold waves-effect waves-light" href="{{ url('notifications') }}" >
                                    <span class="clearfix d-none d-sm-inline-block">Notificatins</span>
                                    <span class="badge danger-color">
                                    <?php 
                                        $user_id=Auth::user()->id;
                                        $notificationcount=DB::table('notifications')
                                        ->join('newsfeeds','notifications.news_id','=','newsfeeds.id')
                                       // ->join('users','newsfeeds.user_id','=','users.id')
                                        ->select('notifications.*')
                                        ->where('notifications.status','=',2)
                                        ->where('notifications.receiver_id','=',$user_id)
                                        ->count();
                                    ?>
                                    {{ $notificationcount }}
                                    </span>
                                 </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle font-weight-bold" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('user/myprofile') }}">{{ __('Profile') }}</a>
                                    <a class="dropdown-item" href="{{ url('status/add') }}">{{ __('Add Status') }}</a>
                                    <a class="dropdown-item" href="{{ url('status/mystatus') }}">{{ __('My Status') }}</a>
                                    <a class="dropdown-item" href="{{ url('question/pendinglist') }}">{{ __('Question List') }}</a>
                                    <a class="dropdown-item" href="{{ url('question/myaskedquestion') }}">{{ __('My Question') }}</a>
                                    <a class="dropdown-item" href="{{ url('user/settings') }}">{{ __('Settings') }}</a>
                                    <a class="dropdown-item" href="{{ url('user/password/reset') }}">{{ __('Change Password') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
</body>
</html>
