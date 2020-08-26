<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientGovernmentTable extends Migration {

	public function up()
	{
		Schema::create('client_government', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('government_id')->unsigned();
			$table->integer('client_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('client_government');
	}
}