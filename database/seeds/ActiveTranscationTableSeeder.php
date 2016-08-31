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
    	for ( $i=1; $i<31; $i++ ) {
    		$receiver                 = mt_rand(1,10) ;
    		$amount                   = mt_rand(1000,20000) ;

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
