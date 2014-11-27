<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActivityRegisterTable extends Migration {

	/**
	 * Run the migrations.
	 * 报名表
	 * @return void
	 */
	public function up()
	{
		Schema::create('activity_register', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
            $table->integer('reg_activity_id'); // 活动id外键
            $table->integer('reg_vlt_id'); // 志愿者id 外键
            $table->integer('reg_status')->default(0);// 是否审核 0未审核，1 审核，－1拒绝
            $table->integer('reg_activity_duration')->default(0); //志愿者时长
            $table->text('reg_vlr_comment')->nullable();// 志愿者评价
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('activity_register');
	}

}
