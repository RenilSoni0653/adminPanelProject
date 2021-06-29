<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendEmail;
use Carbon\Carbon;
use App\Email;

class JobController extends Controller
{
    public function enqueue(Request $request)
    {
        $user = \App\User::find(auth()->user()->id);

        $email = new Email;
        $email->user_id = auth()->user()->id;
        $email->name = $user->fname;
        $email->from_email = $request->input('from_email');
        $email->to_email = $request->input('to_email');
        $email->description = $request->input('description');
        $email->save();

        $details = ['email' => 'srenil0653@gmail.com'];
        $emailJob = (new SendEmail($details))->delay(Carbon::now()->addMinutes(5));
        dispatch($emailJob);

        return redirect('home')->with('success','Mail Send Successfully');
    }
}
