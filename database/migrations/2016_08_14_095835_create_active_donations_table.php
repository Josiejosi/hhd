<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActiveDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('active_donations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('receiver');
            $table->integer('sender');
            $table->float('amount');
            $table->datetime('created_at');
            $table->float('donation_percentage');
            $table->integer('donation_days');
            $table->integer('donation_status');
            $table->boolean('is_processed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('active_donations');
    }
}
