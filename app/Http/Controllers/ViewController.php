<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Newsfeed;
use App\User;
use App\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

class ViewController extends Controller
{
    public function status($id)
    {

        $newsfeed=DB::table('newsfeeds')
        ->join('users','newsfeeds.user_id','=','users.id')
        ->join('statuses','newsfeeds.id','=','statuses.news_id')
        ->join('questions','newsfeeds.id','=','questions.news_id')
        ->join('answers','newsfeeds.id','=','answers.news_id')
        ->select('newsfeeds.*','users.name','statuses.*','questions.*','answers.*')
        ->where('newsfeeds.status','=',1)
        ->where('newsfeeds.id','=',$id)
        ->first();
        $user=User::where('id','=',$newsfeed->user_id)
        ->first();

        $comment=DB::table('comments')
        ->join('users','comments.user_id','=','users.id')      
        ->select('comments.*','users.name','users.avatar')
        ->where('comments.status','=',1)
        ->where('comments.status_id','=',$id)
        ->get();

        return view('view.status',['newsfeeds'=>$newsfeed,'comments'=>$comment,'user'=>$user]);
    }

    public function question($id)
    {
        $newsfeed=DB::table('newsfeeds')
        ->join('users','newsfeeds.user_id','=','users.id')
        ->join('statuses','newsfeeds.id','=','statuses.news_id')
        ->join('questions','newsfeeds.id','=','questions.news_id')
        ->join('answers','newsfeeds.id','=','answers.news_id')
        ->select('newsfeeds.*','users.name','statuses.*','questions.*','answers.*')
        ->where('newsfeeds.status','=',1)
        ->where('newsfeeds.id','=',$id)
        ->first();
        $user=User::where('id','=',$newsfeed->user_id)
        ->first();
        $comment=DB::table('comments')
        ->join('users','comments.user_id','=','users.id')      
        ->select('comments.*','users.name','users.avatar')
        ->where('comments.status','=',1)
        ->where('comments.status_id','=',$id)
        ->get();

        return view('view.question',['newsfeeds'=>$newsfeed,'comments'=>$comment,'user'=>$user]);
    }
    public function notifications()
    {
        $user_id=Auth::user()->id;
        $notifications=DB::table('notifications')
        ->join('users','notifications.asker_id','=','users.id')
        ->join('newsfeeds','notifications.news_id','=','newsfeeds.id')
        ->select('notifications.*','newsfeeds.type as news_type','users.name','users.avatar')
        ->where('notifications.receiver_id','=',$user_id)
        ->orderBy('notifications.status','Desc')
        ->orderBy('notifications.id','Desc')
        ->paginate(15);
        $recentjoin=User::orderBy('id','Desc')
        ->paginate(5);
        return view('view.notification',['notifications'=>$notifications, 'recentjoin'=>$recentjoin]);
    }
}
