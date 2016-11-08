<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPopToActiveDonationsTable extends Migration
{

    public function up()
    {
        Schema::table('active_donations', function (Blueprint $table) {
            $table->string('pop')->nullable();
        });
    }

    public function down()
    {
        Schema::table('active_donations', function (Blueprint $table) {
            //
        });
    }
}
