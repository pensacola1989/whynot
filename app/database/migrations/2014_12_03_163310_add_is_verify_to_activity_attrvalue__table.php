<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddIsVerifyToActivityAttrvalueTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('activity_attrvalue', function(Blueprint $table)
		{
			$table->integer('is_verify')->default(0);
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
