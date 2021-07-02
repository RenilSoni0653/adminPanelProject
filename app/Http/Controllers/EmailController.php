<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Email;
use Mail;

class EmailController extends Controller
{
    public function sendmail()
    {
        return view('theme.email.sendmail');
    }

    public function basic_mail(Request $request,$id)
    {
        //Storing data into database
        $user = User::find($id);

        $email = new Email;
        $email->user_id = auth()->user()->id;
        $email->name = $user->fname;
        $email->from_email = $data['from_email'];
        $email->to_email = $data['to_email'];
        $email->description = $data['description'];
        $email->save();

        // Sending mail
        $from_email = Request()->input('from_email');
        $to_email = Request()->input('to_email');
        $subject = Request()->input('subject');
        $description = Request()->input('description');
        $data = array('name' => $user->fname,'body' => 'Test mail');

        Mail::send(['text' => 'theme.email.emailNotification'],$data, function($message) use ($user, $from_email, $to_email, $subject) {
            $message->to($to_email, 'Test')->subject($subject);
            $message->from($from_email, $user->fname);
        });

        return redirect('home')->with('message','Email send successfully');
    }
}
