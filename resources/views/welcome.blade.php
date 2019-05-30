<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Material Design Bootstrap</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/compiled.min.css')}}" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="{{asset('css/mdb.min.css')}}" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>
<style>
html, 
body {
    height: 100%;
}
</style>
<!-- Main navigation -->
<header>
        <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <strong>Sneaky</strong>
            </a>
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                    <script>
                    window.location.replace("/status/all");
                    </script>

                    @endauth
                </div>
            @endif
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7" aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
                <ul class="navbar-nav mr-auto"> </ul>
                    <form class="form-inline">
                        <div class="md-form mt-0">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                        </div>
                    </form>
            </div>
        </div>
    </nav>
    <!-- Navbar -->

    <!-- Full Page Intro -->
    <div class="view" style="background-image: url('{{asset('images/bg.jpg')}}'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
        <!-- Mask & flexbox options-->
        <div class="mask rgba-teal-light d-flex justify-content-center align-items-center">
        <!-- Content -->
        </div>

        <div class="container">
            <!--Grid row-->
            <div class="row pt-lg-5 mt-lg-5">
                <!--Grid column-->
                <div class="col-md-6 mb-5 mt-md-0 mt-5 white-text text-center text-md-left wow fadeInLeft" data-wow-delay="0.3s">
                    <h1 class="display-4 font-weight-bold">Curious ?</h1>
                    <hr class="hr-light">
                    <h6 class="mb-3"> Want to ask question anonymously ?
                        Let's have some fun .
                    </h6>
                    <a class="btn btn-outline-white" data-toggle="modal" data-target="#modalLoginForm">Learn more</a>
                </div>
                <!--Grid column-->
                
                <div class="col-md-6 col-xl-5 mb-4">
                    <!--Form-->
                    
                    <section class="form-gradient">

                        <!--Form with header-->
                        <div class="card">
                            <!--Header-->
                            <div class="header pt-3 default-color">
                                <div class="row d-flex justify-content-center">
                                    <h3 class="white-text mb-3 pt-3 font-weight-bold">Sign Up</h3>
                                </div>
                            </div>
                            <!--Header-->

                            <div class="card-body mx-4 mt-4">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                Signin Error: 
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                Signin Error: 
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                                <!--Body-->
                                <form method="POST" action="{{ route('userup') }}">
                                @csrf
                                <div class="md-form">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                    <label for="name">Your Name</label>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="md-form pb-1 pb-md-3">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                    <label for="email">Your Email</label>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>    
                                
                                <div class="md-form pb-1 pb-md-2">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    <label for="password">Your Password</label>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="md-form pb-1 pb-md-2">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    <label for="password-confirm">Confirm Password</label>
                                </div>
                                <!--Grid row-->
                                <div class="row d-flex align-items-center mb-4">

                                    <!--Grid column-->
                                    <div class="col-md-1 col-md-5 d-flex align-items-start">
                                        <div class="text-center">
                                            <button type="sumbit" class="btn btn-default btn-rounded z-depth-1a">Sign Up</button>
                                        </div>
                                    </div>
                                    <!--Grid column-->
                                    </form>

                                    <!--Grid column-->
                                    <div class="col-md-7">
                                        <p class="font-small grey-text d-flex justify-content-end mt-3"></p> Already have an account? <a href="#" class="dark-grey-text ml-1 font-weight-bold" data-toggle="modal" data-target="#modalLoginForm"> Sign In  </a></p>
                                    </div>
                                    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header teal white-text text-center">
                                                        <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body mx-3">
                                                    <form method="POST" action="{{ route('userin') }}">
                                                     @csrf
                                                        <div class="md-form mb-5">
                                                            <i class="fa fa-envelope prefix grey-text"></i>
                                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                                            <label  for="email">Your email</label>
                                                            @if ($errors->has('email'))
                                                                <span class="invalid-feedback">
                                                                    <strong>{{ $errors->first('email') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
            
                                                        <div class="md-form mb-4">
                                                            <i class="fa fa-lock prefix grey-text"></i>
                                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                                            <label  for="password">Your password</label>
                                                            @if ($errors->has('password'))
                                                                <span class="invalid-feedback">
                                                                    <strong>{{ $errors->first('password') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                                                                            <!-- Checkbox -->
                                                    <div class="form-check mb-2 mr-sm-2">
                                                        <input class="form-check-input" name="remember" {{ old('remember') ? 'checked' : '' }} type="checkbox" id="remember">
                                                        <label class="form-check-label" for="remember">
                                                            Remember me
                                                        </label>
                                                    </div>
                                                    </div>

                                                            
                                                    <div class="modal-footer d-flex justify-content-center">
                                                        <button type="submit" class="btn btn-default">Login</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="row mt-2 mb-3 d-flex justify-content-center">
                                            <!--Facebook-->
                                        <a class="fa-lg p-2 m-2 fb-ic"><i class="fa fa-facebook white-text fa-lg"> </i></a>
                                        <!--Twitter-->
                                        <a class="fa-lg p-2 m-2 tw-ic"><i class="fa fa-twitter white-text fa-lg"> </i></a>
                                        <!--Google +-->
                                        <a class="fa-lg p-2 m-2 gplus-ic"><i class="fa fa-google-plus white-text fa-lg"> </i></a>
                                    </div>
                                    <!--Grid column-->

                                </div>
                                <!--Grid row-->
                            </div>
                            </div>
                        <!--/Form with header-->
                        <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>



                    </section>
                
                    <!--/.Form-->
                </div>
            <!--Grid column-->
            </div>
            <!--Grid row-->
        </div>
        <!-- Content -->
        
    </div>
    <!-- Full Page Intro -->
    </header>
    <!-- Main navigation -->
    <main>
 

    </main>
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script> 
    </body>
       
    </html>