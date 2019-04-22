@extends('layouts.custom')

@section('content')
<div class="container mt-5" >
    <div class="row pt-5">
        <div class="col ">
        @include('layouts.error')
            <div class="card">
                <div class="card-body">

                    <!-- Nav tabs -->
                    <div class="switch default-switch"> 
                            <ul class="nav classic-tabs tabs-default color" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link waves-light active" data-toggle="tab" href="#panel51" role="tab">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link waves-light" data-toggle="tab" href="#panel52" role="tab">Profile Photo</a>
                                </li>
                            </ul>
                    </div>

                            <!-- Tab panels -->
                            <div class="tab-content card">
                            
                                    <!--Panel 1-->
                                    <div class="tab-pane fade in show active" id="panel51" role="tabpanel">
                                        
                                        <form method="POST" action="{{ route('update_profile') }}"enctype="multipart/form-data">
                                        @csrf

                                            <!-- Default input  -->
                                            <div class="md-form">
                                                <input type="text" id="name" name="name" 
                                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                                value="{{ $user->name }}">

                                                <label for="name" >Full Name</label>
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <!-- /Default input  -->
                                            
                                            <!-- Default input  -->
                                            <div class="md-form">
                                                <input type="text" id="education" name="education" 
                                                class="form-control{{ $errors->has('education') ? ' is-invalid' : '' }}" 
                                                value="{{$user->education}}">

                                                <label for="education" >Education</label>
                                                @if ($errors->has('education'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('education') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <!-- /Default input  -->

                                            <!-- Default input  -->
                                            <div class="md-form">
                                                <textarea id="bio"  
                                                class="form-control{{ $errors->has('bio') ? ' is-invalid' : '' }} md-textarea"
                                                name="bio"
                                                rows="4">{{$user->bio}}</textarea>


                                                <label for="bio" >Bio</label>
                                                @if ($errors->has('bio'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('bio') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <!-- /Default input  -->

                                            <!-- Default input  -->
                                            <div class="md-form">
                                                <input type="text" id="location" name="location" 
                                                class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" 
                                                value="{{$user->location}}">

                                                <label for="location" >Location</label>
                                                @if ($errors->has('location'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('location') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <!-- /Default input  -->

                                            <!-- Default input  -->
                                            <div class="md-form">
                                                <input type="text" id="email" name="email" 
                                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                                value="{{$user->email}}"disabled>

                                                <label for="email" class="disabled">Email</label>
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <!-- /Default input  -->

                                            <!-- Default input  -->
                                            <div class="md-form">
                                                <input type="text" id="relationship_status" name="relationship_status" 
                                                class="form-control{{ $errors->has('relationship_status') ? ' is-invalid' : '' }}" 
                                                value="{{$user->relationship_status}}">

                                                <label for="relationship_status" >Relationship Status</label>
                                                @if ($errors->has('relationship_status'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('relationship_status') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <!-- /Default input  -->

                                            <!-- Default input  -->
                                            <div class="md-form">
                                                <input type="text" id="interest" name="interest" 
                                                class="form-control{{ $errors->has('interset') ? ' is-invalid' : '' }}" 
                                                value="{{$user->interest}}">

                                                <label for="interest" >Interest</label>
                                                @if ($errors->has('interest'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('interest') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <!-- /Default input  -->

                                                
                                                <button type="submit" class="btn btn-default btn-md">Save changes</button>                                               
                                        </form>
                                    </div>
                                    <!--/.Panel 1-->
                                
                                    <!--Panel 2-->
                                    <div class="tab-pane fade" id="panel52" role="tabpanel">
                                        <!-- Default checkbox -->
                                        <form enctype="multipart/form-data" action="/profile" method="POST">
                                            @csrf
                                            <div class="md-form">
                                                <div class="file-field">
                                                    <div class="btn btn-default btn-sm float-left">
                                                        <span>Choose file</span>
                                                        <input type="file" name="avatar">
                                                    </div>
                                                        <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text" placeholder="Upload your image" >
                                                        @if ($errors->has('avatar'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('avatar') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    </div>
                                                </div>                               
                                                <br/>        
                                        <button type="submit" class="btn btn-default btn-md">Update</button>
                                        </form>
                                    
                                    </div>
                                    <!--/.Panel 2-->

                                    <!--Panel 3-->
                                
                                    <!--/.Panel 3-->
                                
                                    <!--Panel 4-->
                                    <div class="tab-pane fade" id="panel54" role="tabpanel">
                                        

                                        <!-- Nav tabs -->
                                        <div class="row">
                                            <div class="col-md-3">
                                                <ul class="nav  md-pills pills-primary flex-column" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-toggle="tab" href="#panel21" role="tab">Change password
                                                        
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#panel22" role="tab">View blocklists
                                                        
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#panel23" role="tab">Deactivate account
                                                        
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#panel23" role="tab">Log out
                                                        
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-9">
                                            <!-- Tab panels -->
                                            <div class="tab-content vertical">
                                                <!--Panel 1-->
                                                <div class="tab-pane fade in show active" id="panel21" role="tabpanel">
                                                    <!-- Default form login -->
                                                    <form>

                                                        <!-- Default input password -->
                                                        <label for="defaultFormLoginPasswordEx" class="grey-text">Old password</label>
                                                        <input type="password" id="defaultFormLoginPasswordEx" class="form-control">

                                                        <br>

                                                        <!-- Default input password -->
                                                        <label for="defaultFormLoginPasswordEx" class="grey-text">New password</label>
                                                        <input type="password" id="defaultFormLoginPasswordEx" class="form-control">

                                                        <br>

                                                        <!-- Default input password -->
                                                        <label for="defaultFormLoginPasswordEx" class="grey-text">Confirm new password</label>
                                                        <input type="password" id="defaultFormLoginPasswordEx" class="form-control">

                                                        <div class="text-center mt-4">
                                                            <button type="submit" class="btn btn-primary btn-md">Confirm</button>
                                                        </div>
                                                    </form>
                                                    <!-- Default form login -->
                                                                        

                                                </div>
                                                <!--/.Panel 1-->

                                                <!--Panel 2-->
                                                <div class="tab-pane fade" id="panel22" role="tabpanel">

                                                
                                                    <div class="col ">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                    <div class="single-news">

                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                    
                                                                                    <!--Image-->
                                                                                    <div class="view overlay rounded z-depth-1">
                                                                                        <img src="https://mdbootstrap.com/img/Photos/Others/photo8.jpg" class="img-fluid" alt="Minor sample post image">
                                                                                        <a>
                                                                                            <div class="mask waves-effect waves-light">

                                                                                            </div>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>

                                                                                
                                                    
                                                                                <!--Excerpt-->
                                                                                <div class="col-md-9">
                                                                                    <p class="dark-grey-text">
                                                                                        <a>Israth Chy</a>
                                                                                    </p>
                                                                                    <div class="row">
                                                                                            <div class="col offset-lg-5">
                                                                                                <a class="btn blue-gradient btn-rounded btn-sm">unblock
                                                                                                </a>
                                                                                            </div>
                                                                                    </div>
                                                                                </div>
                                                    
                                                                            </div>
                                                                    </div>

                                                                        <br>


                                                                            <div class="single-news">

                                                                                <div class="row">
                                                                                    <div class="col-md-3">
                                                        
                                                                                        <!--Image-->
                                                                                        <div class="view overlay rounded z-depth-1">
                                                                                            <img src="https://mdbootstrap.com/img/Photos/Others/photo8.jpg" class="img-fluid" alt="Minor sample post image">
                                                                                            <a>
                                                                                                <div class="mask waves-effect waves-light"></div>
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>

                                                                                    
                                                        
                                                                                    <!--Excerpt-->
                                                                                    <div class="col-md-9">
                                                                                        <p class="dark-grey-text">
                                                                                            <a>Nairita</a>
                                                                                        </p>
                                                                                        <div class="row">
                                                                                                <div class="col offset-lg-5">
                                                                                                    <a class="btn blue-gradient btn-rounded btn-sm">unblock
                                                                                                    </a>
                                                                                                </div>
                                                                                        </div>
                                                                                    </div>
                                                        
                                                                                
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <br>
                                                                            <div class="single-news">

                                                                                    <div class="row">
                                                                                        <div class="col-md-3">
                                                            
                                                                                            <!--Image-->
                                                                                            <div class="view overlay rounded z-depth-1">
                                                                                                <img src="https://mdbootstrap.com/img/Photos/Others/photo8.jpg" class="img-fluid" alt="Minor sample post image">
                                                                                                <a>
                                                                                                    <div class="mask waves-effect waves-light"></div>
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>

                                                                                        
                                                            
                                                                                        <!--Excerpt-->
                                                                                        <div class="col-md-9">
                                                                                            <p class="dark-grey-text">
                                                                                                <a>Nirmita</a>
                                                                                            </p>
                                                                                            <div class="row">
                                                                                                    <div class="col offset-lg-5">
                                                                                                        <a class="btn blue-gradient btn-rounded btn-sm">unblock
                                                                                                        </a>
                                                                                                    </div>
                                                                                            </div>
                                                                                        </div>
                                                            
                                                                                    </div>
                                                                            </div>

                                                                            <br>

                                                                            <div class="single-news">

                                                                                <div class="row">
                                                                                    <div class="col-md-3">
                                                        
                                                                                        <!--Image-->
                                                                                        <div class="view overlay rounded z-depth-1">
                                                                                            <img src="https://mdbootstrap.com/img/Photos/Others/photo8.jpg" class="img-fluid" alt="Minor sample post image">
                                                                                            <a>
                                                                                                <div class="mask waves-effect waves-light"></div>
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>

                                                                                        
                                                            
                                                                                    <!--Excerpt-->
                                                                                    <div class="col-md-9">
                                                                                        <p class="dark-grey-text">
                                                                                            <a>Riya</a>
                                                                                        </p>
                                                                                        <div class="row">
                                                                                                <div class="col offset-lg-5">
                                                                                                    <a class="btn blue-gradient btn-rounded btn-sm">unblock
                                                                                                    </a>
                                                                                                </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <br>
                                            
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                    </div> 
                                                </div>            
                                                <!--/.Panel 2-->
                                                <!--Panel 3-->
                                                <div class="tab-pane fade" id="panel23" role="tabpanel">

                                                        Deactivating your account will disable your Profile and remove your name and photo from most things that you've shared on Facebook. Some information may still be visible to others, such as your name in their Friends list and messages that you've sent.

                                                        If you want to deactive your account,
                                                        <br>
                                                        <br>

                                                        <button type="button" class="btn btn-outline-danger btn-rounded waves-effect">DEACTIVATE ACCOUNT</button>
                                                    </div>
                                                
                                                <!--/.Panel 3-->
        
                                    </div>
                
                                </div>    
                            </div>    
                        </div>    
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
                
@endsection
