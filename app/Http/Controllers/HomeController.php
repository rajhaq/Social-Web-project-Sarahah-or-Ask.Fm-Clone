<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Report;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function reset()
    {
        return view('user.passwordreset');
    }
    public function signin(Request $request)
    {
        if(Auth::attempt(
            [
                'email'=> $request->email,
                'password'=> $request->password
            ]
        ))
        {
            $user=User::where('email',$request->email)->first();
            return redirect('status/all');
        }
        return redirect()->back();

        //return view('shop.user.loginsignup');
    }
    
    public function signup(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]
            );
        $user=new User;
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password=bcrypt($request->input('password'));
        $user->save();
        Auth::attempt(
            [
                'email'=> $request->email,
                'password'=> $request->password
            ]
            );
        
        return redirect('status/all'); 
    }
    public function search(Request $request)
    {
        $search=$request->input('search');;
        $user=User::where('name','LIKE','%'.$search.'%')
        ->get();
        return view('searchresult')->with(['results'=>$user,'search'=>$search] );
    }
    public function report()
    {
        

        $report=DB::table('reports')
        ->join('users','reports.asker_id','=','users.id')
        ->join('questions','reports.question_id','=','questions.id')
        ->select('reports.*','users.name','questions.*','users.id AS asked_id','reports.created_at AS reported_at')
        ->get();
        return view('report')->with(['reports'=>$report] );
    }
    public function reportstore(Request $request)
    {
        $user_id=Auth::user()->id;
        $report=new Report;
        $report->question_id=$request->input('question_id');
        $report->asker_id=$request->input('asker_id');
        $report->reporter_id=$user_id;
        $report->save();
        
        return redirect('question/pendinglist')->with(['response'=>'Reported Successfully'] );
    }
}
