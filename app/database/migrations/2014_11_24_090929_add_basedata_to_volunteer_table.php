<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddBasedataToVolunteerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('volunteer', function(Blueprint $table)
		{
			$table->string('volunteer_name');
            $table->string('volunteer_mobile');
            $table->string('volunteer_email');
            $table->string('volunteer_interest');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('volunteer', function(Blueprint $table)
		{
			
		});
	}

}
