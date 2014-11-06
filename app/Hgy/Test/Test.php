<?php namespace Hgy\Test;

use LaravelBook\Ardent\Ardent;

class Test extends Ardent {
	protected $table = 'test';


	protected $fillable = array('name', 'email', 'title');

	public static $rules = array(
		'title'					=> 'required|between:4,16',
	    'name'                  => 'required|between:4,16',
	    'email'                 => 'required|email'
	);
}
