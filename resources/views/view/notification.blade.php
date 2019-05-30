@extends('layouts.custom')

@section('content')
<div class="container mt-5 " >
<div class="row pt-5">
    <div class="col col-lg-7 ">
        <div class="card">
            <div class="card-body">
                <!-- Default textarea -->
                <div class="tabs-wrapper"> 
                        <ul class="nav classic-tabs default-color" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link waves-light" data-toggle="tab" href="#panel61" role="tab"><i class="fa fa-user fa-2x" aria-hidden="true"></i><br> All</a>
                                 </li>

                          
                        </ul>
                </div>    
                <!-- Tab panels -->
                <!-- Tab panels -->
                <div class="tab-content card">
  
                    <!--Panel 1-->
                    <div class="tab-pane fade in show active" id="panel61" role="tabpanel">

                                
                                            <!--Newsfeed-->
                                            <div class="mdb-feed">
                                
                                            @foreach($notifications -> all() as $notification)
                                            @if($notification->type==1)
                                                <!--Fourth news-->
                                                <div class="news p-2 m-1 { @if($notification->status==2) blue-grey lighten-4 @endif}">
                                
                                                    <!--Label-->
                                                    <div class="label">
                                                            <img  src="/images/avatars/{{$notification->avatar}}" class="rounded-circle z-depth-1-half">
                                                        </div>
                                
                                                    <!--Excert-->
                                                    <div class="excerpt">
                                                        <!--Brief-->
                                                        <div class="brief">
                                                            <a class="name" href="{{ url("user/profile/{$notification->asker_id}") }}">{{ $notification->name}}</a> answered your
                                                            <a class="name" href="{{ url("view/question/{$notification->news_id}") }}">question.</a>
                                                        </div>
                                                        <div class="date">
                                                        {{date('M j, Y H:i',  strtotime($notification->updated_at))}}
                                                        </div>
                                                    </div>
                                
                                                </div>
                                                <!--Fourth news-->
                                                @elseif($notification->type==2)  
                                                <!--Fourth news-->
                                                <div class="news p-2 m-1  { @if($notification->status==2) blue-grey lighten-4 @endif}">
                                
                                                    <!--Label-->
                                                    <div class="label">
                                                            <img  src="{{asset('images/avatars/default.jpg')}}" class="rounded-circle z-depth-1-half">
                                                        </div>
                                
                                                    <!--Excert-->
                                                    <div class="excerpt">
                                                            
                                
                                                        <!--Brief-->
                                                        <div class="brief">
                                                            Someone</a> ask you a 
                                                            <a class="name" href="{{ url("question/pendinglist") }}">question.</a>
                                                        </div>
                                                        <div class="date">
                                                        {{date('M j, Y H:i',  strtotime($notification->updated_at))}}
                                                        </div>
                                                    


                                
                                                    </div>
                                
                                                </div>
                                                @elseif($notification->type==3)
                                                <!--Fourth news-->
                                                <div class="news p-2 m-1  { @if($notification->status==2) blue-grey lighten-4 @endif}">
                                
                                                    <!--Label-->
                                                    <div class="label">
                                                            <img  src="/images/avatars/{{$notification->avatar}}" class="rounded-circle z-depth-1-half">
                                                        </div>
                                
                                                    <!--Excert-->
                                                    <div class="excerpt">
                                                            
                                
                                                    <div class="brief">
                                                        <a class="name" href="{{ url("user/profile/{$notification->asker_id}") }}">{{ $notification->name}}</a> likes your 
                                                        @if($notification->news_type==1)
                                                        <a class="name" href="{{ url("view/status/{$notification->news_id}") }}">post.</a>
                                                        @else
                                                        <a class="name" href="{{ url("view/question/{$notification->news_id}") }}">post.</a>
                                                        @endif
                                                    </div>
                                                    <div class="date">
                                                        {{date('M j, Y H:i',  strtotime($notification->updated_at))}}
                                                    </div>
                                            


                                
                                                    </div>
                                
                                                </div>
                                                <!--Fourth news-->
                                                @elseif($notification->type==4)
                                                <div class="news p-2 m-1  { @if($notification->status==2) blue-grey lighten-4 @endif}">
                                
                                                        <!--Label-->
                                                     <div class="label">
                                                          <img  src="/images/avatars/{{$notification->avatar}}" class="rounded-circle z-depth-1-half">
                                                     </div>
                                    
                                                        <!--Excert-->
                                                        <div class="excerpt">
                                                                
                                    
                                                            <!--Brief-->
                                                            <div class="brief">
                                                                <a class="name" href="{{ url("user/profile/{$notification->asker_id}") }}">{{ $notification->name}}</a> commented on your 
                                                                @if($notification->news_type==1)
                                                                <a class="name" href="{{ url("view/status/{$notification->news_id}") }}">post.</a>
                                                                @else
                                                                <a class="name" href="{{ url("view/question/{$notification->news_id}") }}">post.</a>
                                                                @endif
                                                            </div>
                                                            <div class="date">
                                                                {{date('M j, Y H:i',  strtotime($notification->updated_at))}}
                                                            </div>
                                                        


                                    
                                                        </div>
                                    
                                                    </div>
                                                    <!--Fourth news-->
 
                                        @endif
                                        <?php
                                            //use App\Notification; 
                                            //$notification=new Notification;
                                            //$notification->status=1;
                                            $data=array(
                                                'status'=> 1,
                                            );
                                            App\Notification::where('id','=',$notification->id)->update($data);
                                        ?>
                                        @endforeach
                                        </div>
                                         <!--Fourth news-->
                    </div>
                    {{ $notifications->links() }}
                    <!--/.Panel 1-->
                    <!--Panel 2-->
                    <div class="tab-pane fade " id="panel62" role="tabpanel">
                            <div class="mdb-feed">
                                
                                            
                                    <!--Fourth news-->
                                    <div class="news">
                    
                                        <!--Label-->
                                        <div class="label">
                                                <img  src="" class="rounded-circle z-depth-1-half">
                                            </div>
                    
                                        <!--Excert-->
                                        <div class="excerpt">
                                                
                    
                                            <!--Brief-->
                                            <div class="brief">
                                                <a class="name">Israth Chowdhury</a> ask you a 
                                                <a class="name">question.</a>
                                            </div>
                                            <div class="date">6 minutes ago</div>
                                        


                    
                                        </div>
                    
                                    </div>
                                    <!--Fourth news-->
                                    <div class="news">
                    
                                        <!--Label-->
                                        <div class="label">
                                                <img  src="" class="rounded-circle z-depth-1-half">
                                            </div>
                    
                                        <!--Excert-->
                                        <div class="excerpt">
                                                
                    
                                            <!--Brief-->
                                            <div class="brief">
                                                <a class="name">Nirmita Biswas</a> ask you a
                                                <a class="name">question.</a>
                                            </div>
                                            <div class="date">5 hours ago</div>
                                        


                    
                                        </div>
                    
                                    </div>
                                    <!--Fourth news-->
                                
                                    <div class="news">
                    
                                            <!--Label-->
                                         <div class="label">
                                              <img  src="" class="rounded-circle z-depth-1-half">
                                         </div>
                        
                                            <!--Excert-->
                                            <div class="excerpt">
                                                    
                        
                                                <!--Brief-->
                                                <div class="brief">
                                                
                                                <a class="name">Sushmita Shawan</a> ask you a
                                                    <a class="name">question.</a>
                                                </div>
                                                <div class="date">15 hours ago</div>
                                            


                        
                                            </div>
                        
                                        </div>
                                        <!--Fourth news-->
                                         <!--Fourth news-->
                                    <div class="news">
                    
                                        <!--Label-->
                                        <div class="label">
                                                <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(18)-mini.jpg" class="rounded-circle z-depth-1-half">
                                            </div>
                    
                                        <!--Excert-->
                                        <div class="excerpt">
                                                
                    
                                            <!--Brief-->
                                            <div class="brief">
                                                <a class="name">Suravi Riya</a> ask you a
                                                <a class="name">question</a>
                                            </div>
                                            <div class="date">2 days ago</div>
                                        
                                        </div>
                    
                                    </div>
                                    <!--Fourth news-->
                    
                            </div>
                            
                    </div>
                    <!--/.Panel 2-->
                </div>  
            </div>
        </div>
    </div>
<!-- recent join -->
<div class="col col-lg-5 ">
    <div class="card card-cascade">
        <!-- Card image -->
        <div class="view gradient-card-header default-color">
            <!-- Title -->
            <h2 class="card-header-title mb-3">Recently Joined</h2>
        </div>
        <div class="card-body">
            @foreach($recentjoin->all() as $recentuser)
            <div class="single-news">
                <div class="row">
                    <div class="col-md-3">
                        <!--Image-->
                        <div class="view overlay rounded z-depth-1">
                            <img src="/images/avatars/{{$recentuser->avatar}}" class="img-fluid" alt="Minor sample post image">
                            <a>
                                <div class="mask waves-effect waves-light"></div>
                            </a>
                        </div>
                    </div>

                    <!--Excerpt-->
                    <div class="col-md-9">
                        <p class="dark-grey-text">
                            <a>{{$recentuser->name}}</a>
                        </p>
                        <a href="{{url('user/profile/')."/".$recentuser->id}}" class="btn default-color btn-rounded btn-sm waves-effect waves-light">Curious?
                        </a>
                    </div>

                </div>
            </div>
            @endforeach

        </div>
    </div>

</div>
<!-- recentjoin end -->
                    
        </div>
    
    </div>
                
             
        

</div>
</div>
@endsection
