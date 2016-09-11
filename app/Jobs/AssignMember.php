<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssignMember extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        //
    }
}
