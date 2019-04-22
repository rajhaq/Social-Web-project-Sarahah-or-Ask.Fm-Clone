<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Philosopher" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Jura" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/compiled.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <!--Main Navigation-->
    <header>
    
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark stylish-color-dark scrolling-navbar">
            <div class="container">
            <a class="navbar-brand" href="{{ url('status/all') }}">
                {{ ('Sneaky') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                @guest
                @else
                <li><a class="nav-link text-white" href="{{ url('status/all') }}">{{ __('Newsfeed') }}</a></li>
                @endguest
                    
                </ul>
                <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                       @else
                            <li>
                            <!-- Button trigger modal-->
                                <a class="nav-link text-white ont-weight-bold waves-effect waves-light" data-toggle="modal" data-target="#modalCoupon"><i class="fa fa-search" aria-hidden="true"></i></a>

                                <!--Modal: modalCoupon-->
                                <div class="modal fade top" id="modalCoupon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                data-backdrop="false">
                                <div class="modal-dialog modal-frame modal-top modal-notify modal-info" role="document">
                                    <!--Content-->
                                    <div class="modal-content">
                                        <!--Body-->
                                        <div class="modal-body stylish-color-dark">
                                            <div class="row d-flex justify-content-center align-items-center">
                                            <!-- Material auto-sizing form -->
                                            <form method="POST" action="{{ route('search') }}"enctype="multipart/form-data">
                                            @csrf
                                                <!-- Grid row -->
                                                <div class="form-row align-items-center">


                                                    <!-- Grid column -->
                                                    <div class="col-auto">
                                                        <!-- Material input -->
                                                        <label class="sr-only" for="inlineFormInputGroupMD">Search Here</label>
                                                        <div class="md-form input-group mb-3">
                                                            <input type="text" name="search" class="form-control pl-0 rounded-0" id="inlineFormInputGroupMD">
                                                        </div>
                                                    </div>
                                                    <!-- Grid column -->

                                                    <!-- Grid column -->
                                                    <div class="col-auto">
                                                        <button type="submit" class="btn btn-default waves-effect">Go</button>
                                                        <button type="button" class="btn btn-danger  waves-effect" data-dismiss="modal">X</button>
                                                    </div>
                                                    <!-- Grid column -->
                                                </div>
                                                <!-- Grid row -->
                                            </form>
                                            <!-- Material auto-sizing form -->
                                            </div>
                                        </div>
                                    </div>
                                    <!--/.Content-->
                                </div>
                                </div>
                                <!--Modal: modalCoupon-->
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link ont-weight-bold waves-effect waves-light" href="{{ url('notifications') }}" >
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
                                        $pendingcounter=DB::table('newsfeeds')
                                        ->join('users','newsfeeds.user_id','=','users.id')
                                        ->join('questions','newsfeeds.id','=','questions.news_id')
                                        ->select('newsfeeds.*','users.name','questions.*')
                                        ->where('newsfeeds.status','=',2)
                                        ->where('questions.status','=',1)
                                        ->where('questions.receiver_id','=',$user_id)
                                        ->count();
                                    ?>
                                    {{ $notificationcount }}
                                    </span>
                                 </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle font-weight-bold nav-default" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdown">
                                    <!-- <a class="dropdown-item" href="{{ url('user/myprofile') }}">{{ __('Profile') }}</a>
                                    <a class="dropdown-item" href="{{ url('status/add') }}">{{ __('Add Status') }}</a>
                                    <a class="dropdown-item" href="{{ url('status/mystatus') }}">{{ __('My Status') }}</a>
                                    <a class="dropdown-item" href="{{ url('question/pendinglist') }}">{{ __('Question List') }} {{$pendingcounter}}</a>
                                    <a class="dropdown-item" href="{{ url('question/myaskedquestion') }}">{{ __('My Question') }}</a>
                                    <a class="dropdown-item" href="{{ url('user/settings') }}">{{ __('Settings') }}</a>
                                    <a class="dropdown-item" href="{{ url('user/password/reset') }}">{{ __('Change Password') }}</a> -->
                                    <a class="dropdown-item" href="{{ url('status/mystatus') }}">{{ __('Profile') }}</a>
                                    <a class="dropdown-item" href="{{ url('question/pendinglist') }}">{{ __('Pending Questions ') }}<span class="badge indigo"> {{$pendingcounter}}</span> </a>
                                    <a class="dropdown-item" href="{{ url('question/myaskedquestion') }}">{{ __('My Asked Question') }}</a>
                                    <a class="dropdown-item" href="{{ url('user/settings') }}">{{ __('Settings') }}</a>
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
            </div>
            </div>
        </nav>

    </header>

    
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
