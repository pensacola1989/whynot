<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddVolDurationToActivityAttrvalueTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('activity_attrvalue', function(Blueprint $table)
		{
			$table->integer('vol_duration');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('activity_attrvalue_', function(Blueprint $table)
		{
			
		});
	}

}
