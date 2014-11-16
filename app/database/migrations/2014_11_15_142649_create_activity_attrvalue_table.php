<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActivityAttrvalueTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activity_attrvalue', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
            $table->integer('uid'); // frontend user's id
            $table->integer('activity_id'); // belongs to which activity
            $table->text('value'); // json type,stores user's input data
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('activity_attrvalue');
	}

}
