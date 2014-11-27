<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActivitySignTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activity_sign', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps(); //增删改时间，只有增
            $table->integer('sign_activity_id'); //活动id，外键，在模型中建立关系,通过此id可以关联到公益组织用户
            $table->integer('sign_vlt_id');  // 志愿者id，外键，同上
            $table->integer('sign_des')->nullable(); // 相关描述，备用
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('activity_sign');
	}

}
