<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActivityCompleteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activity_complete', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
            $table->integer('cpl_activity_id');//外键
            $table->integer('cpl_activity_des')->nullable; //活动情况
            $table->integer('cpl_activity_duration')->default(0); //活动时长
            $table->integer('cpl_activity_reply')->nullable; // 感谢内容
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('activity_complete');
	}

}
