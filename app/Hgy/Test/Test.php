<?php namespace Hgy\Test;

use McCool\LaravelAutoPresenter\PresenterInterface;
use Hgy\Core\Entity;

class Test extends Entity implements PresenterInterface {
	protected $table = 'tests';


	protected $fillable = array('name', 'email', 'title', 'testname');

	public static $rules = array(
		'title'					=> 'required|between:4,16',
	    'name'                  => 'required|between:4,16',
	    'email'                 => 'required|email'
	);

    public function getPresenter()
    {
        return TestPresenter::class;
    }
}
