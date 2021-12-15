<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Notification;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Str;
use App\Notifications\VerifyEmailNotification;
use Mail;
use App\User;


class VerifyUserEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data    = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $verifyToken = Str::random(20);;
        User::where('email',$this->data->email)->update([
            'email_verified_at'=>"yes",
            'remember_token'=> $verifyToken
        ]);
        $details = [
            'greeting' => 'Hi '.$this->data->name,
            'body' => 'This notification is for you email verification',
            'thanks' => 'Thank you for using DUMMY WEB',
            'actionText' => 'Click to verify',
            'actionURL' => url('account-modification/'.$verifyToken),
            'order_id' => 90

        ];
        Notification::send($this->data , new VerifyEmailNotification($details));
    }
}
