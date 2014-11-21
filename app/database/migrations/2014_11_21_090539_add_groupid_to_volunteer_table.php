<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddGroupidToVolunteerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('volunteer', function(Blueprint $table)
		{
			$table->integer('groupd_id');
            $table->integer('org_id'); //公益组织id
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
