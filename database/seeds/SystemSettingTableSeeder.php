<?php

use Illuminate\Database\Seeder;


class SystemSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_settings')->insert([
    		"percentage"=>30,
            "days"=>3,
            "daily_reserves"=>2,
            "expiry_hours"=>4,
            "start_help_time"=>"10:00:00",
            "end_help_time"=>"10:30:00",
    		"count_down_hours"=>4,
    		"is_active"=>1,
        ]);
        DB::table('system_settings')->insert([
    		"percentage"=>60,
            "days"=>3,
    		"daily_reserves"=>2,
            "expiry_hours"=>4,
            "start_help_time"=>"03:00:00",
            "end_help_time"=>"00:00:00",
            "count_down_hours"=>4,
    		"is_active"=>0,
        ]);
        DB::table('system_settings')->insert([
    		"percentage"=>100,
            "days"=>12,
    		"daily_reserves"=>2,
            "expiry_hours"=>4,
            "start_help_time"=>"03:00:00",
            "end_help_time"=>"00:00:00",
            "count_down_hours"=>4,
    		"is_active"=>0,
        ]);
    }
}
