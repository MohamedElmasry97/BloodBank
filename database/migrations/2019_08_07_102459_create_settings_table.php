<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('client_phone');
            $table->text('content');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('settings');
    }
}
