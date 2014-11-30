<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveCplActivityDesFromActivityCompleteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('activity_complete', function(Blueprint $table)
		{
			$table->dropColumn('cpl_activity_des');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('activity_complete_', function(Blueprint $table)
		{
			
		});
	}

}
