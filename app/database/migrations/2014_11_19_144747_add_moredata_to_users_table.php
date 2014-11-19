<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddMoredataToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->string('u_cp_unit');
            $table->string('u_pw_industry');
            $table->string('u_province');
            $table->string('u_address');
            $table->integer('u_postcode')->nullable();
            $table->integer('u_teamsize');
            $table->string('u_target_area');
            $table->string('u_target_people');
            $table->string('u_username');
            $table->integer('u_mobile');
            $table->string('u_other_contact')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			
		});
	}

}
