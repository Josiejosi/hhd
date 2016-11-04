<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *        'ip_address', 
     *   'user_agent',
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('cell_phone')->unique();
            $table->string('password');
            $table->string('dob');
            $table->string('country');
            $table->string('avatar');
            $table->string('timezone');
            $table->boolean('is_special_user');
            $table->boolean('is_verified');
            $table->string('verification_code');
            $table->string('refferal_key');
            $table->string('ip_address');
            $table->string('user_agent');
            $table->boolean('is_active');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
