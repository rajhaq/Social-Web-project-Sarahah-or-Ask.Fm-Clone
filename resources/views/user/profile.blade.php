@extends('layouts.custom')
@section('content')
<div class="container mt-5" >
        <div class="row pt-5">
            <div class="col col-lg-7   col-sm-12">
                <div class="card">
                    
                    <div class="card-body">
                        <!-- Default textarea -->
                        <!-- Tab panels -->
                        <div class=" card">
                            <div class="card-header default-color white-text">Ask {{ $user->name }}</div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('Question_store') }}"enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <textarea id="status"  class="form-control{{ $errors->has('question_body') ? ' is-invalid' : '' }}" name="question_body" value="{{ old('question_body') }}" required autofocus rows="4"></textarea>
                                        <!-- Switch -->
                                        <div class="switch default-switch m-2">
                                        <label>
                                            Off
                                            <input type="checkbox" name="anonymous">
                                            <span class="lever "></span>
                                            On
                                        </label>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-8">

                                        <input id="hide" type="hidden" name="id" value="{{ $user->id }}"  >

                                        <button type="submit" class="btn btn-default">
                                            {{ __('Ask Question') }}
                                        </button>

                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                        </div>
                        <!--Section: Social newsfeed v.1-->
                        <section class="pt-5 pb-3">

                            <!--Grid row-->
                                <div class="row">
                                    <!--Grid column-->
                                    <div class="col-lg-12">
                            
                                        <!--Newsfeed-->
                                        <div class="mdb-feed">
                                        @foreach($newsfeeds->all() as $status)
                                        @if($status->type==1)

                                            <!--Fourth news-->
                                            <div class="news">
                                                    <!--Label-->
                                                    <div class="label">
                                                        <img src="/images/avatars/{{$status->avatar}}" class="rounded-circle z-depth-1-half">
                                                    </div>
                                
                                                    <!--Excert-->
                                                    <div class="excerpt">
                                
                                                        <!--Brief-->
                                                        <div class="brief">
                                                            <a class="name" href="{{ url("user/profile/{$status->user_id}") }}">{{ $status->name }}</a>
                                                            <div class="date">{{date('M j, Y H:i',  strtotime($status->updated_at))}}</div>
                                                        </div>
                                
                                                        <!--Added text-->
                                                        <div class="added-text">{{ $status->status_body }}</div>
                                                        @if($status->attachment)
                                                            <div class="row">
                                                                <div class="col-lg-6 view overlay zoom">
                                                                    <img src="{{$status->attachment}}" class="img-fluid" alt="Responsive image">
                                                                </div>
                                                            </div>
                                                        
                                                        @endif
                                                        <!--Feed footer-->
                                                        <!-- query for like comments -->
                                                        <?php 
                                                            // use App\News_feed;
                                                            // use App\Heart;
                                                            $user_id=Auth::user()->id;
                                                            $heartPost=DB::table('newsfeeds')
                                                            ->find($status->id);
                                                            $heartCounter=DB::table('hearts')
                                                            ->where('status_id', '=',$heartPost->id)
                                                            ->count();
                                                            $commentsCounter=DB::table('comments')
                                                            ->where('status_id', '=',$heartPost->id)
                                                            ->count();
                                                            $like_user=DB::table('hearts') 
                                                            ->where(['user_id' =>$user_id,'status_id'=>$heartPost->id])->first();
                                                            if(empty($like_user->user_id)){
                                                                $likeExist=0;
                                                            }
                                                            else{
                                                                $likeExist=1;
                                                            }
                                                    
                                                            
                                                        // $user_prof
                                                        ?>
                                                    

                                                        <div class="feed-footer">
                                                            @if($likeExist==1)
                                                            <a class="like red-text" href="{{ url("status/heartdelete/{$like_user->id}") }}">
                                                                <i class="fa fa-heart red-text"></i>
                                                                <span>{{ $heartCounter }} likes</span>
                                                            </a>
                                                            @else
                                                            <a class="like"  href="{{ url("status/heart/{$status->id}") }}">
                                                                <i class="fa fa-heart"></i>
                                                                <span>{{ $heartCounter }} likes</span>
                                                            </a>
                                                            @endif
                                                            <div class="feed-footer">
                                                                    <a class="comment" data-toggle="collapse" href="#collapseExample{{$status->id}}" aria-expanded="false" aria-controls="collapseExample-4">Comment</a> &middot;
                                                                    <span>
                                                                    <a type="button"  data-toggle="modal" data-target="#exampleModal{{$status->id}}">{{$commentsCounter}}</a>
                                                                    </span>
                                                                    
                                                                <div class="collapse" id="collapseExample{{$status->id}}">
                                                                    <div class="card card-body mt-1">
                                                                    <form method="POST" action="{{ route('status_comment') }}"enctype="multipart/form-data">
                                                                        @csrf
                                                                        <!--Add comment-->
                                                                        <div class="md-form mt-1 mb-1">
                                                                            <textarea name="comment" type="text" id="form7" class="md-textarea"></textarea>
                                                                            <label for="form7">Add comment</label>
                                                                        </div>
                                                                        <div class="d-flex justify-content-end">
                                                                        <input id="hide" class="btn btn-elegant" type="hidden" name="status_id" value="{{ $status->id }}"  >
                                                                            <button type="button"  class="btn btn-elegant"  data-toggle="collapse" data-target="#collapseExample-3" aria-expanded="false"
                                                                                aria-controls="collapseExample{{$status->id}}">Cancel</button>
                                                                            <button type="submit" class="btn btn-default" >Reply</button>
                                                                        
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Fourth news-->
                                                                               <!-- /like -->
                                            <!-- Modal -->
                                            <!-- Full Height Modal Right -->
                                            <div class="modal fade" id="exampleModal{{$status->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form method="POST" action="{{ route('status_comment') }}"enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header container">
                                                            <h5 class="modal-title" id="exampleModalLabel">Comments</h5>

                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body container">
                                                        <!-- feed -->
                                                            <div class="mdb-feed"> 
                                                            
                                                                @foreach($comments->all() as $comment)
                                                                    @if($comment->status_id==$status->id)
                                                                <!-- single news -->
                                                                <div class="news">
                                                    
                                                                            <!--Label-->
                                                                            <div class="label">
                                                                                <img src="/images/avatars/{{$comment->avatar}}" class="rounded-circle z-depth-1-half">
                                                                            </div>
                                                        
                                                                            <!--Excert-->
                                                                            <div class="excerpt">
                                                        
                                                                            <!--Brief-->
                                                                            <div class="brief">
                                                                                <a class="name">{{$comment->name}}
                                                                                </a>
                                                                                <div class="date">
                                                                                        {{date('M j, Y H:i',  strtotime($comment->updated_at))}}

                                                                                </div>
                                                                                @if($user_id==$comment->user_id)
                                                                                <a href="{{ url("status/comment/delete/{$comment->id}") }}" >Delete<i class="fa fa-trash"></i></a>
                                                                                @endif
                                                                            </div>
                                                        
                                                                                <!--Added text-->
                                                                                <div class="added-text">{{$comment->comment_body}} </div>
                                                        
                                                                                <!--Feed footer-->
                                                                                <div class="feed-footer">
                                                                                
                                                                                    <div class="feed-footer">
                                                                                        
                                                                                
                                                                                    </a>

                                                                                    </div>
                                                                                </div>
                                                        
                                                                            </div>
                                                        
                                                                        </div>
                                                            <!-- /single news -->
                                                            @endif
                                                            @endforeach

                                                            </div>
                                                            <!-- /feed -->
                                                
                                                            <div class="col-md-12">
                                                            <strong>Write Comment</strong>
                                                            <textarea id="status"  class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="comment" value="{{ old('comment') }}" required autofocus rows="4"></textarea>

                                                            </div>
                                                            <div class="modal-footer">
                                                            <input id="hide" type="hidden" name="status_id" value="{{ $status->id }}"  >
                                                                <button type="button" class="btn btn-elegant" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-default">Add Comment</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>   
                                        </div>
                                        
                                        @elseif($status->type==2)

                                        <!--Fourth news-->
                                        <div class="news">
                                                <!--Label-->
                                                <div class="label">
                                                    <img src="/images/avatars/{{$status->avatar}}" class="rounded-circle z-depth-1-half">
                                                </div>

                                                <!--Excert-->
                                                <div class="excerpt">

                                                    <!--Brief-->
                                                    <?php 
                                                        $askedby=DB::table('users')
                                                        ->find($status->receiver_id);
                                                        
                                                    // $user_profile = User_profile::where('user_id','=',$user_id)->get();
                                                    ?>
                                                    <div class="brief">
                                                        <a class="name" href="{{ url("user/profile/{$status->user_id}") }}">{{ $status->name }}</a> answered 
                                                        @if($status->anonymous==0)
                                                        <a href="{{ url("user/profile/{$askedby->id}") }}">
                                                        {{ $askedby->name }}</a>'s question
                                                        @else
                                                        Anonymous</a>'s question
                                                        @endif
                                                        <div class="date">{{date('M j, Y H:i',  strtotime($status->updated_at))}}</div>
                                                    </div>

                                                    <!--Added text-->
                                                    <div class="added-text"> <i class="fa fa-question-circle" ></i> {{ $status->question_body }}</div>
                                                    <div class="added-text"> <i class="fa fa-mail-reply-all" aria-hidden="true"></i> {{ $status->answer_body }}</div>
                                                    @if($status->attachment)
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <img src="{{$status->attachment}}" class="img-thumbnail" alt="Responsive image">
                                                            </div>
                                                        </div>
                                                    
                                                    @endif
                                                    <!-- query for like comments -->
                                                    <?php 
                                                        // use App\News_feed;
                                                        // use App\Heart;
                                                        $user_id=Auth::user()->id;
                                                        $heartPost=DB::table('newsfeeds')
                                                        ->find($status->id);
                                                        $heartCounter=DB::table('hearts')
                                                        ->where('status_id', '=',$heartPost->id)
                                                        ->where('status', '=',1)
                                                        ->count();
                                                        $commentsCounter=DB::table('comments')
                                                        ->where('status_id', '=',$heartPost->id)
                                                        ->where('status', '=',1)
                                                        ->count();
                                                        $like_user=DB::table('hearts') 
                                                        ->where(['user_id' =>$user_id,'status_id'=>$heartPost->id])->first();
                                                        if(empty($like_user->user_id)){
                                                            $likeExist=0;
                                                        }
                                                        else{
                                                            $likeExist=1;
                                                        }
                                                
                                                        
                                                    // $user_prof
                                                    ?>
                                                

                                                    <div class="feed-footer">
                                                        @if($likeExist==1)
                                                        <a class="like red-text" href="{{ url("status/heartdelete/{$like_user->id}") }}">
                                                            <i class="fa fa-heart red-text"></i>
                                                            <span>{{ $heartCounter }} likes</span>
                                                        </a>
                                                        @else
                                                        <a class="like"  href="{{ url("status/heart/{$status->id}") }}">
                                                            <i class="fa fa-heart"></i>
                                                            <span>{{ $heartCounter }} likes</span>
                                                        </a>
                                                        @endif
                                                        <div class="feed-footer">
                                                                <a class="comment" data-toggle="collapse" href="#collapseExample{{$status->id}}" aria-expanded="false" aria-controls="collapseExample-4">Comment</a> &middot;
                                                                <span>
                                                                <a type="button"  data-toggle="modal" data-target="#exampleModal{{$status->id}}">{{$commentsCounter}}</a>
                                                                </span>
                                                                
                                                                
                                                            <div class="collapse" id="collapseExample{{$status->id}}">
                                                                <div class="card card-body mt-1">
                                                                    <form method="POST" action="{{ route('status_comment') }}"enctype="multipart/form-data">
                                                                    @csrf
                                                                    <!--Add comment-->
                                                                    <div class="md-form mt-1 mb-1">
                                                                        <textarea name="comment" type="text" id="form7" class="md-textarea"></textarea>
                                                                        <label for="form7">Add comment</label>
                                                                    </div>
                                                                    <div class="d-flex justify-content-end">
                                                                    <input id="hide" type="hidden" name="status_id" value="{{ $status->id }}"  >
                                                                        <button type="button" class="btn btn-elegant" data-toggle="collapse" data-target="#collapseExample-3" aria-expanded="false"
                                                                            aria-controls="collapseExample{{$status->id}}">Cancel</button>
                                                                        <button type="submit" class="btn btn-default" >Reply</button>
                                                                    
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Fourth news-->
                                                                        <!-- /like -->
                                            <!-- Modal -->
                                            <!-- Full Height Modal Right -->
                                            <div class="modal fade" id="exampleModal{{$status->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <form method="POST" action="{{ route('status_comment') }}"enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-content">
                                            <div class="modal-header container">
                                            <h5 class="modal-title" id="exampleModalLabel">Comments</h5>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body container">
                                            <!-- feed -->
                                            <div class="mdb-feed"> 

                                            @foreach($comments->all() as $comment)
                                                @if($comment->status_id==$status->id)
                                            <!-- single news -->
                                            <div class="news">

                                                        <!--Label-->
                                                        <div class="label">
                                                            <img src="/images/avatars/{{$comment->avatar}}" class="rounded-circle z-depth-1-half">
                                                        </div>

                                                        <!--Excert-->
                                                        <div class="excerpt">

                                                        <!--Brief-->
                                                        <div class="brief">
                                                            <a class="name">{{$comment->name}}
                                                            </a>
                                                            <div class="date">
                                                                    {{date('M j, Y H:i',  strtotime($comment->updated_at))}}

                                                            </div>
                                                            @if($user_id==$comment->user_id)
                                                            <a href="{{ url("status/comment/delete/{$comment->id}") }}" >Delete<i class="fa fa-trash"></i></a>
                                                            @endif
                                                        </div>

                                                            <!--Added text-->
                                                            <div class="added-text">{{$comment->comment_body}} </div>

                                                            <!--Feed footer-->
                                                            <div class="feed-footer">
                                                            
                                                                <div class="feed-footer">
                                                                    
                                                            
                                                                </a>

                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                            <!-- /single news -->
                                        @endif
                                        @endforeach
                                        </div>
                                        <!-- /feed -->
                            
                                        <div class="col-md-12">
                                        <strong>Write Comment</strong>
                                        <textarea id="status"  class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="comment" value="{{ old('comment') }}" required autofocus rows="4"></textarea>

                                        </div>
                                        <div class="modal-footer">
                                        <input id="hide" type="hidden" name="status_id" value="{{ $status->id }}"  >
                                            <button type="button" class="btn btn-elegant" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-default">Add Comment</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>   
                    </div>
                    @endif
        @endforeach
                </div>
            </div>

    </div>
</div>
</div>
</div>
<div class="col col-lg-5 ">
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
                <h6 class="mb-3 font-weight-bold teal-text">{{$user->email}}</h6>
            
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
                        <p>{{$user->interest}} </p>
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
                        <p>{{$user->location}} </p>
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
                        <p>{{$user->education}} </p>
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
                        <p>{{$user->relationship_status}} </p>
                    </div>
                </div>
                    <!--Review-->
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

