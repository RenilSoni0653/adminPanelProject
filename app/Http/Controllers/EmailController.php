<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendEmail;
use App\User;
use App\Email;
use Carbon\Carbon;
use Mail;

class EmailController extends Controller
{
    public function sendmail()
    {
        return view('theme.email.sendmail');
    }

    public function enqueue(Request $request)
    {
        $description = strip_tags(htmlspecialchars_decode($request->input('description')));
        $user = \App\User::find(auth()->user()->id);

        $request->validate([
            'from_email' => 'required|email',
            'to_email' => 'required|email',
            'subject' => 'required|string',
            'description' => 'required|string'
        ],
        [
            'from_email.required' => 'From email is required',
            'to_email.required' => 'To email is required',
            'subject.required' => 'Subject is required',
            'description.required' => 'Description is required'
        ]);

        $email = new Email;
        $email->user_id = auth()->user()->id;
        $email->name = $user->fname;
        $email->subject = $request->input('subject');
        $email->from_email = $request->input('from_email');
        $email->to_email = $request->input('to_email');
        $email->description = $description;
        $email->save();

        $emailJob = (new SendEmail($email));//->delay(Carbon::now()->addMinutes(1));
        dispatch($emailJob);

        return redirect('home')->with('success','Mail Send Successfully');
    }
}
