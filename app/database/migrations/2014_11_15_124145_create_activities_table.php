<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
            $table->integer('bizid');
            $table->text('content');
            $table->text('finish_tip');
            $table->string('channels'); // example:1,2 or 1,2,3 or 1 (split with ',')
            $table->tinyInteger('can_edit');
            $table->timestamp('end_time');
            $table->tinyInteger('is_verify');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('activities');
	}

}
