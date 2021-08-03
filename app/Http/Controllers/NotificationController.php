<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use App\Notifications\NewMessage;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $message = new Message;
        $message->setAttribute('from','renilsoni0653@gmail.com');
        $message->setAttribute('to','srenil0653@gmail.com');
        $message->setAttribute('message','Hi');
        $message->save();

        $fromUser = User::find(1);
        $toUser = User::find(2);

        $toUser->notify(new NewMessage($fromUser));
        Notification::send($toUser,new NewMessage($fromUser));

        // return redirect('home');
    }
}
