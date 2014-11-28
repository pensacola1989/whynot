<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserVolunteerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_volunteer', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
            $table->integer('org_id'); // 指向users表的userid
            $table->integer('vol_id'); // 指向volunteer_id
            $table->integer('group_id')->default(0); // 多对多group，每个志愿者在公益组织的分组都不同
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user__volunteer');
	}

}
