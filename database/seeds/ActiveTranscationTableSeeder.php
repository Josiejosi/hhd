<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon ;

class ActiveTranscationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('active_donations')->insert([
	    	"receiver"=>1,
	    	"sender"=>0,
	    	"amount"=>650,
	    	"created_at"=> Carbon::now(),
	    	"donation_percentage"=>30,
	    	"donation_days"=>3,
	    	"donation_status"=>'pending',
	    	"is_processed"=>0,
        ]);
        DB::table('active_donations')->insert([
	    	"receiver"=>1,
	    	"sender"=>0,
	    	"amount"=>1300,
	    	"created_at"=> Carbon::now(),
	    	"donation_percentage"=>30,
	    	"donation_days"=>3,
	    	"donation_status"=>'pending',
	    	"is_processed"=>0,
        ]);
        DB::table('active_donations')->insert([
	    	"receiver"=>1,
	    	"sender"=>0,
	    	"amount"=>1300,
	    	"created_at"=> Carbon::now(),
	    	"donation_percentage"=>30,
	    	"donation_days"=>3,
	    	"donation_status"=>'pending',
	    	"is_processed"=>0,
        ]);
    }
}
