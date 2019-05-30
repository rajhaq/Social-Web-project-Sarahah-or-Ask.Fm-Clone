@extends('layouts.custom')

@section('content')
<div class="container mt-5 " >
    <div class="row pt-5">
                  <div class="col-md-12 mb-5">
                        <!--Featured image-->
                        <div class="card card-cascade wider reverse">
                            <div class="view overlay">
                            @if($newsfeeds->attachment)
                                <img class="card-img-top" src="{{$newsfeeds->attachment}}" alt="Wide sample post image">
                                <a>
                                    <div class=""></div>
                                </a>
                                @endif
                            </div>

                            <!--Post data-->
                            <div class="card-body text-center ">
                                <h2><a><strong>{{$newsfeeds->status_body}}</strong></a></h2>
                                <p>Written at {{date('M j, Y H:i',  strtotime($newsfeeds->created_at))}}</p>

                            </div>
                        <!--Post data-->
                        </div>

                        <!--Excerpt-->

                </div>
  
                <div class="col-lg-7 ">

                    <div class="card">
                        <div class="card-body">
                            
                            <section class="mb-4 pt-5 wow fadeIn" data-wow-delay="0.3s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.3s;">

                                <!--Main wrapper-->
                                <div class="comments-list text-center text-md-left mb-5">
                                    <div class="text-center mb-4">
                                        <h3 class="font-weight-bold">Comments

                                        </h3>
                                    </div>
                                    @foreach($comments->all() as $comment)
                                    <!--First row-->
                                    <div class="row mb-4">
                                        <!--Image column-->
                                        <div class="col-sm-2 col-12 mb-md-0 mb-3">
                                            <img height="60px" width="60px"src="/images/avatars/{{$comment->avatar}}" class="img-fluid rounded-circle z-depth-2">
                                        </div>
                                        <!--/.Image column-->
                                        <!--Content column-->
                                        <div class="col-sm-10 col-12">
                                            <a>
                                                <h4 class="font-weight-bold">{{$comment->name}}</h4>
                                            </a>
                                            <div class="mt-2">
                                                <ul class="list-unstyled">
                                                    <li class="comment-date">
                                                        <i class="fa fa-clock-o"></i> {{date('M j, Y H:i',  strtotime($comment->updated_at))}}</li>
                                                </ul>
                                            </div>
                                            <p class="black-text">{{$comment->comment_body}} </p>
                                        </div>
                                        <!--/.Content column-->
                                    </div>
                                    <!--/.First row-->
                                    @endforeach

                                </div>
                                <!--/.Main wrapper-->
                    
                            </section>
                            <section class="pb-5 mt-5 wow fadeIn" data-wow-delay="0.3s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.3s;">

                                <!--Leave a reply form-->
                                <div class="reply-form">
                                <form method="POST" action="{{ route('status_comment') }}"enctype="multipart/form-data">
                                @csrf
                                    <input id="hide" type="hidden" name="status_id" value="{{ $newsfeeds->id }}"  >
                                    <h3 class="section-heading h3 pt-5">Leave a Comment </h3>
                    
                                    <!--Third row-->
                                    <div class="row">
                                        
                                        <!--/.Image column-->
                    
                                        <!--Content column-->
                                        <div class="col-12">
                                        <!--Grid row-->
                                            <div class="row">
                    
                                                <div class="col-12">
                                                    <div class="md-form mt-0">
                                                        <textarea type="text" class="form-control md-textarea" id="comment" rows="3" placeholder="Your message..."></textarea>
                                                    </div>
                    
                                                    <div class="text-right mt-4">
                                                        <button type="submit" class="btn btn-teal btn-rounded waves-effect waves-light">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <!--Grid row-->
                                        </div>
                    
                                    </div>
                                    <!--Third row-->
                                </form>
                                </div>
                            
                                <!--/.Leave a reply form-->
                            </section>
                        </div>    
                    </div>  
                </div>  
                    
                <div class="col-lg-5 ">
                    <div class="card">
                        <div class="card-body">
                                    
                            <div class="testimonial">
                                <!--Avatar-->
                                <div class="avatar mx-auto">
                                <img src="/images/avatars/{{$user->avatar}}" class="rounded-circle z-depth-1 img-fluid">
                                </div>
        
                                <!--Content-->
                                <h4 class="mb-3 dark-grey-text">
                                    <strong>{{$user->name}}</strong>
                                </h4>
                                <div class="row mb-2">
                                    <div class="col-2">
                                        <i class="fa fa-edit prefix fa-2x"></i>
                                    </div>
                                    <div class="col-10 text-left">
                                        <h5 class="font-weight-bold">Bio</h5>
                                        <p>{{$user->bio}}</p>
                                    </div>
                                </div>
                                <!--/ Material Text with icon -->
                                <!-- Material Text with icon -->
                                <div class="row mb-2">
                                    <div class="col-2">
                                        <i class="fa fa-smile-o prefix fa-2x"></i>
                                    </div>
                                    <div class="col-10 text-left">
                                        <h5 class="font-weight-bold"> Interests </h5>
                                        <p >{{$user->interest}}</p>
                                    </div>
                                </div>
                                <!--/ Material Text with icon -->

                                <!-- Material Text with icon -->
                                <div class="row mb-2">
                                    <div class="col-2">
                                        <i class="fa fa-location-arrow prefix fa-2x"></i>
                                    </div>
                                    <div class="col-10 text-left">
                                        <h5 class="font-weight-bold">Location</h5>
                                        <p >{{$user->location}}</p>
                                    </div>
                                </div>
                                <!--/ Material Text with icon -->
                                <!-- Material Text with icon -->
                                <div class="row mb-2">
                                    <div class="col-2">
                                        <i class="fa fa-2x a fa-book prefix"></i>
                                    </div>
                                    <div class="col-10 text-left">
                                        <h5 class="font-weight-bold">Education</h5>
                                        <p>{{$user->education}}</p>
                                    </div>
                                </div>
                                <!-- Material Text with icon -->
                                    <!-- Material Text with icon -->
                                <div class="row mb-2">
                                    <div class="col-2">
                                        <i class="fa fa-2x fa-heart text"></i>
                                    </div>
                                    <div class="col-10 text-left">
                                        <h5 class="font-weight-bold">Relationship Status</h5>
                                        <p >{{$user->relationship_status}}</p>
                                    </div>
                                </div>
                                <!--Review-->
                            </div>
                        </div>
                    </div>
                </div>          <!--/.Panel 1-->

    </div>
</div>
@endsection
