<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserbaseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('userbase', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
            $table->string('password');
            $table->string('remember_token')->nullable();
            $table->string('username');
            $table->string('email');
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
		Schema::drop('userbase');
	}

}
