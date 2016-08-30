<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemSettingsTable extends Migration
{
    /**
     * Run the migrations. //xngyjmvfotxvbrmb reserves
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->float("percentage");
            $table->integer("days");
            $table->integer("daily_reserves");
            $table->integer("expiry_hours");
            $table->time("start_help_time");
            $table->time("end_help_time");
            $table->boolean("is_active");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('system_settings');
    }
}
