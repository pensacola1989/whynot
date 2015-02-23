<?php namespace whynot;

use Controller;
use View;
use DB;
use Input;
use Redirect;

class ShakeController extends Controller {

	const BEGIN_TIME = '2015-02-23 14:43';

	const HOUR_GAP = 0.5;

	public function __construct()
	{
		date_default_timezone_set('Asia/Shanghai');
	}

	public function enter()
	{
		
		if(time() > strtotime(self::BEGIN_TIME)) {
			return Redirect::action('whynot\ShakeController@getNickShow');
		}
		return View::make('mobile.whynot');
	}

	public function getNickShow()
	{
		return View::make('whynot.nickname');
	}

	public function index()
	{
		$totalUsers = $this->getUsers();
		date_default_timezone_set('Asia/Shanghai');
		// echo strtotime('2015-01-28 00:30');exit();
		$percent = $this->getPercent();
		if($percent == 0) {
			return Redirect::action('whynot\ShakeController@result');
		}
		return View::make('whynot.shake', compact('percent', 'totalUsers'));
	}

	public function result()
	{
		// $ret = DB::table('whynot')->get();
		// dd($ret);exit();
		return View::make('whynot.result');
	}

	private function getPercent()
	{
		$duration = time() - strtotime(self::BEGIN_TIME);
		if($duration < 0) {
			return 100;
		}
		if($duration > 0 && $duration < self::HOUR_GAP * 3600) {
			return 75;
		}
		if($duration > 6 * 3600 && $duration < self::HOUR_GAP * 2 * 3600) {
			return 50;
		}
		if($duration > 12 * 3600 && $duration < self::HOUR_GAP * 3 * 3600) {
			return 25;
		}
		else {
			return 0;		
		}
	}

	public function postNickName()
	{
		$nickName = Input::get('nickname');
		$this->insertUser($nickName);
		return Redirect::action('whynot\ShakeController@index');
	
	}

	private function insertUser($userName)
	{
		DB::table('whynot')->insert(
			['user_name'=>$userName, 'start_time'=>time()]
		);
	}

	private function getUsers()
	{
		return DB::table('whynot')->get();
	}
}