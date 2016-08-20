<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ActiveTranscationTableSeeder::class);
        $this->call(SystemSettingTableSeeder::class);
    }
}
