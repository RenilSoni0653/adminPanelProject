<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
            'password' => 'required|min:6'
        ]);

        if(!$data)
        {
            return redirect('login')->withErrors($data);
        } 
        else 
        {
            $userData = array(
                'email' => $request->input('email'),
                'password' => $request->input('password')
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
        return view('theme.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first-name' => 'required|string|max:255',
            'last-name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'password' => 'required|min:6',
        ]);

        $user = new User;
        $user->fname = $request->input('first-name');
        $user->lname = $request->input('last-name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        
        if($request->input('password') == $request->input('re-password'))
        {
            $user->save();
            return redirect('login')->with('success','User registered successfully');
        }
        else
        {
            return redirect('register')->with('message','Enter password again');
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
}
