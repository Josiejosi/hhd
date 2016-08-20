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
    		"is_active"=>1,
        ]);
        DB::table('system_settings')->insert([
    		"percentage"=>60,
    		"days"=>3,
    		"is_active"=>0,
        ]);
        DB::table('system_settings')->insert([
    		"percentage"=>100,
    		"days"=>12,
    		"is_active"=>0,
        ]);
    }
}
