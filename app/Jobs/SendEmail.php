<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\EmailForQueuing;
use Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 3;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $description = strip_tags(htmlspecialchars_decode(Request()->input('description')));
        $email = new EmailForQueuing();

        $user = \App\User::find(auth()->user()->id);
        $from_email = Request()->input('from_email');
        $to_email = Request()->input('to_email');
        $subject = Request()->input('subject');
        $data = array('name' => $user->fname,'body' => 'Test mail');

        Mail::send(['text' => 'theme.email.emailnotification'],$data, function($message) use ($user, $from_email, $to_email, $subject) {
            $message->to($to_email, 'Test')->subject($subject);
            $message->from($from_email, $user->fname);
        });

        // Mail::to($this->details['email'])->send($email,$data, function($message) {
        //     $message->attachment($);
        // });
    }
}
