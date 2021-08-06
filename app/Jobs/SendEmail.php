<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\EmailForQueuing;
use Carbon\Carbon;
use Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $emails = new EmailForQueuing();
        $data = new EmailForQueuing();

        Mail::send('theme.Email.emailnotification', [$data], function($message) {
            $message->to($this->email['to_email'], 'Test');
            $message->subject($this->email['subject']);
            $message->from($this->email['from_email'], $this->email['name']);
        });
    }
}