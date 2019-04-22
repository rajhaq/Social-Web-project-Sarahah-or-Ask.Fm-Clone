<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Notification;

use Auth;


use App\Question;
use App\Newsfeed;
use App\Answer;
use App\Status;

class QuestionController extends Controller
{
    public function store(Request $postdata)
    {
        $user_id=Auth::user()->id;
        $receiver_id=$postdata->input('id');

        $this->validate($postdata,
        [
            'question_body'=> 'required'
        ]
        );

        $newsfeed=new Newsfeed;
        $newsfeed->user_id=$user_id;
        $newsfeed->type=2;
        $newsfeed->status=2;
        $newsfeed->save();
        $news_id=$newsfeed->id;

        $question=new Question;
        $question->question_body=$postdata->input('question_body');
        $question->news_id=$news_id;
        if($postdata->input('anonymous'))
        $question->anonymous=1;
        else
        $question->anonymous=0;

        $question->receiver_id=$postdata->input('id');
        $question->save();

        $notification=new Notification;
        $notification->type=2;
        $notification->asker_id=$user_id;
        $notification->receiver_id=$receiver_id;
        $notification->news_id=$news_id;
        $notification->save();

        return redirect('user/profile/'.$receiver_id)->with(['response'=>'Question Added Successfully']);  
    }

    public function pendinglist()
    {
        $user_id=Auth::user()->id;
        // $statuses=Status::where('status','=',1)
        // ->where('user_id','=',$user_id)
        // ->get();
        $newsfeed=DB::table('newsfeeds')
        ->join('users','newsfeeds.user_id','=','users.id')
        ->join('questions','newsfeeds.id','=','questions.news_id')
        ->select('newsfeeds.*','users.name','questions.*','questions.id AS que')
        ->where('newsfeeds.status','=',2)
        ->where('questions.status','=',1)
        ->where('questions.receiver_id','=',$user_id)
        ->get();
        return view('user.pendinglist',['questions'=>$newsfeed]);
    }

    public function answer(Request $request)
    {
        $user_id=Auth::user()->id;
        $this->validate($request,
        [
            'answer'=> 'required',
        ]
        );
        $answer=new Answer;
        $answer->answer_body=$request->input('answer');
        $answer->receiver_id=$request->input('receiver_id');
        $answer->news_id= $request->input('news_id');
        $answer->save();
        $news_id=$request->input('news_id');
        $newsfeed=new Newsfeed;
        $newsfeed->status=1;
        $data=array(
            'status'=> 1,
        );
        Newsfeed::where('id','=',$news_id)->update($data);
        $newsfeed->update();

        //null status for newsfeed
        $status=new Status;
        $status->status_body='';
        $status->news_id=$request->input('news_id');
        $status->attachment= '';
        $status->save();
        $notification=new Notification;
        $notification->type=1;
        $notification->asker_id=$user_id;
        $notification->receiver_id=$request->input('receiver_id');
        $notification->news_id=$news_id;
        $notification->save();


        return redirect('question/pendinglist')->with(['response'=>'Question Replied Successfully']); 
    }
    

    public function myaskedquestions()
    {
        $user_id=Auth::user()->id;
        // $statuses=Status::where('status','=',1)
        // ->where('user_id','=',$user_id)
        // ->get();
        $newsfeed=DB::table('questions')
        ->join('newsfeeds','questions.news_id','=','newsfeeds.id')
        ->join('users','questions.receiver_id','=','users.id')
        ->select('newsfeeds.*','users.name','questions.*')
        ->where('newsfeeds.user_id','=',$user_id)
        ->paginate(5);
        return view('user.myaskedquestion',['questions'=>$newsfeed]);
    }

    public function delete_question($id)
    {
        $question=new Question;
        $question->status=0;
        $data=array(
            'status'=> 0,
        );
        Question::where('id','=',$id)->update($data);
        $question->update();
        return redirect('question/pendinglist')->with(['response'=>'Question Deleted Successfully'] );  
    }


}
