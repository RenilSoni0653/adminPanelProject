<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
use Mail;


class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id','!=',auth()->user()->id)->get();
        
        return view('users.index',compact('users'));
    }

    // public function forgotPass(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email'
    //     ],
    //     [
    //         'email.required' => 'Enter email-id correctly!!'
    //     ]);
    //     $email = DB::table('users')->where('email','=',$request->input('email'))->get();
    //     $token_id = Str::random(18);
        
        
    //     $query = DB::table('password_resets')->insert([
    //         'email' => $request->input('email'),
    //         'token' => $token_id
    //     ]);

    //     if(count($email) > 0)
    //     {
    //         Mail::send(['text' => 'forget_password'], ['token' => $token_id],
    //         function($message) use($request) {
    //                 $message->to($request->email);
    //                 $message->subject('Forgot-password link');
    //             }
    //         );
    //     }
    //     else
    //     {
    //         return back()->with('error',"Email-id doesn't exist");
    //     }

    //     return back()->with('success','Reset password link send successfully');
    // }

    // public function verifyPassword($token, Request $request)
    // {
    //     $query = DB::table('password_resets')->where('token',$token)->select('email', 'token')->get();
        
    //     if(count($query) == 0) {
    //         abort(404, 'Page not found');
    //     } else {
    //         if($query[0]->token == $token)
    //         {
    //             $email = $query[0]->email;
    //             return view('resetPassword', compact('email', 'token'));
    //         }
    //         else
    //         {
    //             return view('Login');
    //         }
    //     }   
    // }

    // public function updatePassword(Request $request)
    // {
    //     $request->validate([
    //         'password' => 'required',
    //         'repassword' => 'required',
    //     ],
    //     [
    //         'password.required' => 'Password field is required',
    //         'repassword.required' => 'Re-Password field is required',
    //     ]);

    //     $user = User::where('email',$request->email)->select('id','email')->get();
    //     $data = User::find($user[0]->id);
        
    //     if($request->input('password') == $request->input('repassword'))
    //     {
    //         $Del_query = DB::table('password_resets')->where('token',$request->Token)->delete();
    //         $query = $data->update([
    //             'password' => Hash::make($request->input('password'))
    //         ]);
    //     }
    //     else
    //     {
    //         return back()->with('error',"Password doesn't match");
    //     }

    //     return redirect('login')->with('success','Password updated successfully');
    // }

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
