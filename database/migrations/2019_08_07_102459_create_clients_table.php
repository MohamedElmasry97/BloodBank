<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->date('birthdate');
            $table->string('password');
            $table->string('phone');
            $table->date('donation_last_date');
            $table->integer('blood_type_id')->unsigned();
            $table->timestamps();
            $table->integer('city_id')->unsigned();
            $table->boolean('is_active')->default(1);
            $table->string('api_token', 60)->unique()->nullable();
            $table->integer('pin_code')->unsigned()->nullable();
        });
    }

    public function down()
    {
        Schema::drop('clients');
    }
}
