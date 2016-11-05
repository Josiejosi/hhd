<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon ;

class ActiveTranscationTableSeeder extends Seeder
{
    /**
     * Run the database seeds. php artisan db:seed --class=ActiveTranscationTableSeeder
     *
     * @return void
     */
    public function run()
    {
        $s = 0 ;
    	for ( $i=1; $i<11; $i++ ) {
    		$receiver                 = mt_rand(1,10) ;

            if ( $s == 0 ) {
    		  $amount                   = 500 ;
              $s=1 ;
            }
            else {
              $amount                   = 1500 ;
              $s=0 ;                
            }

	        DB::table('active_donations')->insert([
		    	"receiver"           => $receiver,
		    	"sender"             => 0,
		    	"amount"             => $amount,
		    	"created_at"         => Carbon::now(),
		    	"booked_at"          => "",
		    	"donation_percentage"=> 30,
		    	"donation_days"      => 3,
		    	"donation_status"    => 0,
		    	"is_processed"       => 0,
	        ]);
    	}
    }
}
