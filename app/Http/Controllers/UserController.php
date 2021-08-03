<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mail;
use DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id','!=',auth()->user()->id)->get();
        
        return view('users.index',compact('users'));
    }

    public function forgotPass(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ],
        [
            'email.required' => 'Enter email-id correctly!!'
        ]);
        $query = DB::table('users')->where('email','=',$request->input('email'))->get();

        if(count($query) > 0)
        {
            Mail::send(['text' => 'forget_password'], ['token' => $request->input('_token'), 'email' => $request->input('email')],
            function($message) use($request) {
                    $message->to($request->email);
                    $message->subject('Forgot-password link');
                }
            );
        }
        else
        {
            return back()->with('error',"Email-id doesn't exist");
        }

        return back()->with('success','Reset password link send successfully');
    }

    public function verifyPassword($token, $email, Request $request)
    {
        if($request->token == $token)
        {
            return view('resetPassword',compact('email'));
        }
        else
        {
            return view('Login');
        }
        
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'repassword' => 'required',
        ],
        [
            'password.required' => 'Password field is required',
            'repassword.required' => 'Re-Password field is required',
        ]);

        $user = User::where('email',$request->email)->select('id','email')->get();
        $data = User::find($user[0]->id);
        
        if($request->input('password') == $request->input('repassword'))
        {
            $query = $data->update([
                'password' => \Hash::make($request->input('password'))
            ]);
        }
        else
        {
            return back()->with('error',"Password doesn't match");
        }

        return back()->with('success','Password updated successfully');
    }

    // public function follow(User $user)
    // {
    //     $follower = auth()->user();
    //     if($follower == $user->id) {
    //         return back()->withError('You cannot follow yourself');
    //     }
    //     if(!$follower->isFollowing($user->id)) {
    //         $follower->follow($user->id);

    //         $user->notify(new UserFollowed($follower));
    //         return back()->withSuccess('You are now friends with {$user->name}');
    //     }
    //     return back()->withError('You are already following {$user->name}');
    // }

    // public function unfollow(User $user)
    // {
    //     $follower = auth()->user();
    //     if(!$follower->isFollowing($user->id)) {
    //         $follower->unfollow($user->id);

    //         return back()->withSuccess('You are no longer friends with {$user->name}');
    //     }
    //     return back()->withError('You are not following {$user->name}');
    // }

    // public function notifications()
    // {
    //     return auth()->user()->unreadNotification()->limit(5)->get()->toArray();
    // }
}
