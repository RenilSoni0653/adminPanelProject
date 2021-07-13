<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id','!=',auth()->user()->id)->get();
        
        return view('users.index',compact('users'));
    }

    public function follow(User $user)
    {
        $follower = auth()->user();
        if($follower == $user->id) {
            return back()->withError('You cannot follow yourself');
        }
        if(!$follower->isFollowing($user->id)) {
            $follower->follow($user->id);

            $user->notify(new UserFollowed($follower));
            return back()->withSuccess('You are now friends with {$user->name}');
        }
        return back()->withError('You are already following {$user->name}');
    }

    public function unfollow(User $user)
    {
        $follower = auth()->user();
        if(!$follower->isFollowing($user->id)) {
            $follower->unfollow($user->id);

            return back()->withSuccess('You are no longer friends with {$user->name}');
        }
        return back()->withError('You are not following {$user->name}');
    }

    public function notifications()
    {
        return auth()->user()->unreadNotification()->limit(5)->get()->toArray();
    }
}
