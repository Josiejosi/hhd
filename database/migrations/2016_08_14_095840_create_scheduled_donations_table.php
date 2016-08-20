<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduledDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduled_donations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->float('schedule_percentage');
            $table->datetime('schedule_at');
            $table->datetime('schedule_for');
            $table->integer('schedule_days');
            $table->float('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('scheduled_donations');
    }
}
