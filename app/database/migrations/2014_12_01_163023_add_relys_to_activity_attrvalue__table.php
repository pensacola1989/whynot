<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddRelysToActivityAttrvalueTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('activity_attrvalue', function(Blueprint $table)
		{
			$table->text('vol_reply')->default(null);
            $table->text('at_reply')->default(null);
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
