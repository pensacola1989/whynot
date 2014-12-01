<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFieldToActivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('activities', function(Blueprint $table)
		{
            $table->string('title')->nullable();
            $table->string('area')->nullable();
            $table->string('start_time')->nullable();
//            title
//            area
//            start_time
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('activities_', function(Blueprint $table)
		{
			
		});
	}

}
