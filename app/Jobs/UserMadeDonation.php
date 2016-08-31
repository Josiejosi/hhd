<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Classes\Helper ;

class UserMadeDonation extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $info ;

    public function __construct($info)
    {
        $this->info = $info ;
    }

    public function handle()
    {
        Helper::send_mail( 
            $this->info['to_email'], 
            $this->info['subject'], 
            $this->info['to_name'] , 
            $this->info['message'] , 
            "emails.confirm"
        ) ;

        Helper::send_sms($this->info['sms_message'], $this->info['cell_phone']) ;
    }
}
