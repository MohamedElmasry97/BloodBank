<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonatesTable extends Migration
{
    public function up()
    {
        Schema::create('donates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('age')->nullable();
            $table->integer('blood_type_id')->unsigned();
            $table->integer('no_bags');
            $table->string('hospital_name');
            $table->string('phone');
            $table->integer('client_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->double('longitude', 10, 8)->nullable();
            $table->double('latitude', 10, 8)->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('donates');
    }
}
