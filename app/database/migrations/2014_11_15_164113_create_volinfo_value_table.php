<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVolinfoValueTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('volinfo_value', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
            $table->integer('vol_id'); // belongs to which volunteer
            $table->text('value'); // json format string
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('volinfo_value');
	}

}
