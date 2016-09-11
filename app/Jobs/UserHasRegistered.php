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
    protected $verification_code ;
    protected $password ;
    protected $refferal_key ;

    public function __construct($user, $verification_code, $refferal_key, $password)
    {
        $this->user              = $user ;
        $this->verification_code = $verification_code ;
        $this->password          = $password ;
        $this->refferal_key      = $refferal_key ;
    }

    public function handle()
    {
        $verification_code       = $this->verification_code ;
        $refferal_key            = $this->refferal_key ;

        $url                     = url( '/signin/' . $refferal_key ) ;

        Helper::send_mail( 
            $this->user->email, 
            "Welcome to PrestigeWallet", 
            $this->user->first_name . " " . $this->user->last_name , 
            "We hope your doing well, here are your".
            "<br />Username: " . $this->user->email . "<br />Password: " . $this->password .
            "<br /><br />Referral Key : $refferal_key<br /><br />" . 
            "<br /><br />Referral URL : <a href='$url'>$url</a><br /><br />", 
            "emails.confirm"
        ) ;

        $sms_message = "Hi " . $this->user->first_name . " " . $this->user->last_name . ", your verification code to complete your profile is:  $verification_code" ;

        Helper::send_sms( $sms_message, $this->user->cell_phone) ;
    }
}
