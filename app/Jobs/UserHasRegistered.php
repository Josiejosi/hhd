<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Classes\Helper ;

class UserHasRegistered extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user ;
    public function __construct($user)
    {
        $this->user = $user ;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Helper::send_mail( 
            $this->user->email, 
            "Welcome to PrestigeWallet", 
            $this->user->first_name . " " . $this->user->last_name , 
            "We hope your doing well, here is your verification code: $verification_code<br />Username: " . $this->user->email . "<br />Password: " . $this->user->password, 
            "emails.confirm",
            true 
        ) ;
    }
}
