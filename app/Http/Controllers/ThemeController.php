<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Table;
use Auth;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    public function index()
    {   
        return view('theme.index');
    }

    public function forgotPassword()
    {
        return view('theme.forgot-password');
    }

    public function home(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'pwd' => 'required|min:5'
        ]);

        if(!$data)
        {
            return redirect('login')->withErrors($data);
        } 
        else 
        {
            $userData = array(
                'email' => $request->input('email'),
                'password' => $request->input('pwd')
            );

            if(Auth::attempt($userData))
            {
                return view('theme.index')->with('success','Login successfully');    
            }
            else
            {
                return redirect('login')->with('error','Enter Correct credentials');
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:5'
        ],
        [
            'first_name.required' => 'First-name field is required',
            'last_name.required' => 'Last-name field is required',
            'email.required' => 'Email field is required',
            'password.required' => 'Password field is required'
        ]);

        $query = \DB::table('users')->where('email','=',$request->input('email'))->pluck('email');
        $user = new User;
        $user->fname = $request->input('first_name');
        $user->lname = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        if($query[0] == $request->email || $request->input('password') == $request->input('re_password'))
        {
            $user->save();
            return redirect('login')->with('success','User registered successfully');
        }
        else
        {
            return redirect('register')->with('message','Enter correct credentials again');
        }
    }

    public function login()
    {
        return view('theme.login');
    }

    public function register()
    {
        return view('theme.register');
    }

    public function log()
    {
        $data = \DB::table('activity_logs')
        ->where('user_id','=',auth()->user()->id)
        ->orderBy('last_login_at','DESC')
        ->get();
        
        return view('theme.activity_log',compact('data'));
    }
    
    public function setting()
    {
        $id = auth()->user()->id;
        $record = User::find($id);

        return view('theme.setting',compact('record'));
    }

    public function destroy($id)
    {
        $record = User::find($id);
        $record->delete();

        return redirect('home')->with('success','User Deleted Successfully');
    }
}
