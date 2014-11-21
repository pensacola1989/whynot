<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVolunteergruopsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('volunteergruops', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('group_name');
            $table->integer('org_id');// 公益组织id
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('volunteergruops');
	}

}
