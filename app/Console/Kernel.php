<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Classes\Helper ;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // Commands\Inspire::class,
    ];

    protected function schedule(Schedule $schedule)
    {

        $schedule->call(function () {
            // Move scheduled to active
            //Helper::moveScheduledDonationsToActiveDonations() ;
            // Delete inactive users
            //Helper::inactivateNonDonor48hours() ;
            // Delete users with not play interest.
            //Helper::removeUsersNotDonated48hour() ;
        })->everyMinute() ;
    }
}
