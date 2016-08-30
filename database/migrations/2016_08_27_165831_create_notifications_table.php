<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id'); //if 0 all users receive notification else only user with id receives the message
            $table->string('message');
            $table->integer('type'); //1- approve user request, 2-referral created account with ur code, 3 u made a donation
            /*
                # meaning the donation was successful with the receiver approving and everythiing
                4= u change your primary account
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notification');
    }
}
