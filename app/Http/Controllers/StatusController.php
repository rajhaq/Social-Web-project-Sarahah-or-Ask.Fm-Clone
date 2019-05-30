<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Auth;
use App\Status;
use App\Question;
use App\Newsfeed;
use App\Answer;
use App\Comment;
use App\Heart;
use App\User;
use App\Notification;



class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add()
    {
        return view('status.add');
    }

    public function store(Request $postdata)
    {

        $user_id=Auth::user()->id;
        $this->validate($postdata,
        [
            'status'=> 'required',
        ]
        );

        $newsfeed=new Newsfeed;
        $newsfeed->user_id=$user_id;
        $newsfeed->type=1;
        $newsfeed->save();
        $news_id=$newsfeed->id;


        $status=new Status;
        $status->status_body=$postdata->input('status');
        $status->news_id=$news_id;
        if(Input::hasFile('attachment'))
        {
            $file=Input::file('attachment');
            $file->move(public_path().'/images/attachment/', $file->getClientOriginalName());
            $url=URL::to("/").'/images/attachment/'. $file->getClientOriginalName();
            $status->attachment= $url;
            
        }
        else
        {
            $status->attachment= '';
        }
        $status->save();

        //extra null question and answer save 

        $question=new Question;
        $question->question_body='';
        $question->news_id=$news_id;
        $question->anonymous=0;
        $question->receiver_id=$user_id;
        $question->save();

        $answer=new Answer;
        $answer->answer_body='';
        $answer->receiver_id=0;
        $answer->news_id= $news_id;
        $answer->save();



        return redirect('status/all')->with(['response'=>'Status Added Successfully'] );  
    }
    
    public function all()
    {
        $user_id=Auth::user()->id;
        // $statuses=Status::where('status','=',1)
        // ->get();
//table join
        $newsfeed=DB::table('newsfeeds')
        ->join('users','newsfeeds.user_id','=','users.id')
        ->join('statuses','newsfeeds.id','=','statuses.news_id')
        ->join('questions','newsfeeds.id','=','questions.news_id')
        ->join('answers','newsfeeds.id','=','answers.news_id')
        ->select('newsfeeds.*','newsfeeds.status AS news_status','newsfeeds.id AS news_id',
        'users.name','users.avatar','statuses.*','questions.*','answers.*')
        ->where('newsfeeds.status','=',1)
        ->orderBy('newsfeeds.id','Desc')
        ->paginate(50);

        $comment=Comment::where('status','=',1)
        ->get();

        $comment=DB::table('comments')
        ->join('users','comments.user_id','=','users.id')      
        ->select('comments.*','users.name','users.avatar')
        ->where('comments.status','=',1)
        ->get();
        $recentjoin=User::orderBy('id','Desc')
        ->paginate(5);

        // $heart=Heart::where('status','=',1)
        // ->get();

        return view('status.all',['newsfeeds'=>$newsfeed,'user_id'=>$user_id,'comments'=>$comment,'recentjoin'=>$recentjoin]);
    }
    public function mystatus()
    {
        $user_id=Auth::user()->id;
        $user=Auth::user();
        // $statuses=Status::where('status','=',1)
        // ->get();
//table join
        $newsfeed=DB::table('newsfeeds')
        ->join('users','newsfeeds.user_id','=','users.id')
        ->join('statuses','newsfeeds.id','=','statuses.news_id')
        ->join('questions','newsfeeds.id','=','questions.news_id')
        ->join('answers','newsfeeds.id','=','answers.news_id')
        ->select('newsfeeds.*','newsfeeds.status AS news_status','newsfeeds.id AS news_id',
        'users.name','users.avatar','statuses.*','questions.*','answers.*')
        ->where('questions.receiver_id','=',$user_id)
        ->where('newsfeeds.status','=',1)
        ->orderBy('newsfeeds.id','Desc')
        ->paginate(15);

        $comment=Comment::where('status','=',1)
        ->get();

        $comment=DB::table('comments')
        ->join('users','comments.user_id','=','users.id')      
        ->select('comments.*','users.avatar','users.name')
        ->where('comments.status','=',1)
        ->get();

        // $heart=Heart::where('status','=',1)
        // ->get();

        return view('status.mystatus',['newsfeeds'=>$newsfeed,'user_id'=>$user_id,'comments'=>$comment,'user'=>$user]);
        
    }

    public function edit($id)
    {
        $status =Status::where('id','=',$id)
        ->first();
        return view('status.edit')->with(['status'=>$status]);
    }

    public function delete($id)
    {
        $user_id=Auth::user()->id;
        $newsfeed=new Newsfeed;
        $newsfeed->status=0;
        $data=array(
            'status'=> 0,
        );
        Newsfeed::where('id','=',$id)->update($data);
        $newsfeed->update();
        return redirect('status/mystatus')->with(['response'=>'Status Deleted Successfully'] );  
    }
    
    public function update(Request $request)
    {
        $status_id=$request->input('status_id');
        $user_id=Auth::user()->id;
        $this->validate($request,
        [
            'status'=> 'required',
        ]

        );
    if(Input::hasFile('attachment'))
    {
        $file=Input::file('attachment');
        $file->move(public_path().'/images/attachment/', $file->getClientOriginalName());
        $url=URL::to("/").'/images/attachment/'. $file->getClientOriginalName();
        
    }
    else
    {
        $url= $request->input('attachment');
    }
    $status=new Status;
    $status->status_body=$request->input('status');
    $status->attachment=$url;
    $data=array(
        'status_body'=> $status->status_body,
       'attachment'=> $status->attachment,
    
    
    );
        Status::where('id','=',$status_id)->update($data);
        $status->update();
        return redirect('status/mystatus')->with(['response'=>'Status updated Successfully'] );  
    }

    public function comment(Request $request)
    {
        $user_id=Auth::user()->id;
        $newsfeed=Newsfeed::find($request->input('status_id'));
        $this->validate($request,
        [
            'comment'=> 'required',
        ]
        );
        $comment=new Comment;
        $comment->comment_body=$request->input('comment');
        $comment->status_id=$request->input('status_id');
        $comment->user_id= $user_id;
        $comment->save();

        $notification=new Notification;
        $notification->type=4;
        $notification->asker_id=$user_id;
        $notification->receiver_id=$newsfeed->user_id;
        $notification->news_id=$request->input('status_id');
        $notification->save();
        return redirect()->back();
//        return redirect('status/all')->with(['response'=>'Comment added Successfully'] );  
    }
    
    public function heart($id)
    {
        $user_id=Auth::user()->id;
        $heart=new Heart;
        $heart->status_id=$id;
        $heart->user_id=$user_id;
        $heart->save();

        $heart=Heart::where('status','=',1)
        ->get();

    
        return redirect('status/all')->with(['response'=>'you liked this post Successfully'] );  
    }
    
    public function heart_delete($id)
    {
        $user_id=Auth::user()->id;
        
        Heart::where('id','=',$id)->delete();
        
        return redirect('status/all')->with(['response'=>'Heart Deleted Successfully'] ); 
    }
    public function heartadd($id)
    {
        $user_id=Auth::user()->id;
        $newsfeed=Newsfeed::find($id);
        $like_user= Heart::where(['user_id' =>$user_id,'status_id'=>$id])->first();
        if(empty($like_user->user_id)){
            $status_id=$id;
            $like=new Heart;
            $like->user_id=$user_id;
            $like->status_id=$status_id;
            $like->save();

            $notification=new Notification;
            $notification->type=3;
            $notification->asker_id=$user_id;
            $notification->receiver_id=$newsfeed->user_id;
            $notification->news_id=$status_id;
            $notification->save();

            return redirect("status/all");
        }
        else
        {
            return redirect("status/all");
        }

    }

    public function delete_comment($id)
    {
        
        Comment::where('id','=',$id)->delete();
        return redirect('status/all')->with(['response'=>'Comment Deleted Successfully'] );  
    }

}
