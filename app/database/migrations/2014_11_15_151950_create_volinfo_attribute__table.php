<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVolinfoAttributeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        // volunteer's infomation attibute
		Schema::create('volinfo_attribute', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();

            $table->string('attr_name');
            $table->string('attr_field_name');
            $table->string('attr_des');
            $table->string('attr_type');
            $table->text('attr_extra');// if attr_type is select radio etc,extra store the information
            $table->string('attr_default_val'); // default value
            $table->string('attr_remark'); // remark
            $table->string('is_must');
            $table->integer('sort_number');
            $table->integer('vol_id'); // reference talbe 'users_table'
            $table->string('validate_rule');
            $table->tinyInteger('is_active'); // if not active,don't show
            $table->tinyInteger('is_init'); // if it is init,that can not be deleted
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('volinfo_attribute_');
	}

}
