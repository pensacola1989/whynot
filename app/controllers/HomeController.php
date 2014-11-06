<?php
use Hgy\Test\Test;
use Hgy\Test\TestRepository;

class HomeController extends BaseController {

	private $testRepo;

	function __construct(TestRepository $test) {
		$this->testRepo = $test;
	}
	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getShow()
	{
		$data = array(
			'name'	=>	'fuck',
			'email'	=>	'sdfdsmgal.com',
			'title'	=>	'fuck title2',
			'body'	=>	'fuck body'
		);
		if(!$this->testRepo->storeData($data)){
			return $this->testRepo->getErrorMsg();
		} 
		else {
			return 'sucess';
		}
		
		// return $this->testRepo->getAll();
	}

	public function showWelcome()
	{
		return View::make('hello');
	}


}
