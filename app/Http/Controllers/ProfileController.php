<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Auth;
use App\Status;
use App\Notification;
use App\Newsfeed;
use App\Comment;
use App\Heart;
use App\User;
use Image;

class ProfileController extends Controller
{
    public function profile($id)
    {
        $user_id=Auth::user()->id;
        $user=Auth::user();

        $newsfeed=DB::table('newsfeeds')
        ->join('users','newsfeeds.user_id','=','users.id')
        ->join('statuses','newsfeeds.id','=','statuses.news_id')
        ->join('questions','newsfeeds.id','=','questions.news_id')
        ->join('answers','newsfeeds.id','=','answers.news_id')
        ->select('newsfeeds.*','users.name','users.avatar','statuses.*','questions.*','answers.*')
        ->where('newsfeeds.status','=',1)
        ->where('newsfeeds.user_id','=',$id)
        ->orderBy('newsfeeds.id','Desc')
        ->get();

        $comment=Comment::where('status','=',1)
        ->get();

        $comment=DB::table('comments')
        ->join('users','comments.user_id','=','users.id')      
        ->select('comments.*','users.avatar','users.name')
        ->where('comments.status','=',1)
        ->get();

        $user=User::where('id','=',$id)
        ->first();

        return view('user.profile',['newsfeeds'=>$newsfeed,'user_id'=>$user_id,'comments'=>$comment,'user'=>$user]);
    }
    
    public function myprofile()
    {
        $x=Auth::user();
        return view('user.myprofile',array('user'=>$x));
    }

    public function update_avatar(Request $request){
        //handle the user upload of avatar
       
        if($request->hasFile('avatar')){
            $avatar=$request->file('avatar');
            $filename=time() .'.' .$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save(public_path('images/avatars/' .$filename));

            $user = Auth::user();
            $user ->avatar =$filename;
            $user->save();
        }
        return redirect('user/settings')->with(['response'=>'Profile Image Updated Successfully'] );
    }

    public function settings()
    {
        $user_id=Auth::user()->id;
        $user =User::where('id','=',$user_id)
        ->first();
        return view('user.settings')->with(['user'=>$user]);
    }

    public function update_profile(Request $request)
    {
        $user_id=Auth::user()->id;
        $this->validate($request,
        [
            'name'=> 'required',
        ]

        );
        $user=new User;
        $user->name=$request->input('name');
        $user->bio=$request->input('bio');
        $user->location=$request->input('location');
        $user->education=$request->input('education');
        $user->relationship_status=$request->input('relationship_status');
        $user->interest=$request->input('interest');
        $data=array(
            'name'=>$user->name,
            'bio'=>$user->bio,
            'location'=>$user->location,
            'education'=>$user->education,
            'relationship_status'=>$user->relationship_status,
            'interest'=>$user->interest,
        
    
        );
        User::where('id','=',$user_id)->update($data);
        $user->update();
        return redirect('user/settings')->with(['response'=>'Profile Updated Successfully'] );
    }
    
}
