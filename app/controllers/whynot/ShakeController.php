<?php namespace whynot;

use Controller;
use View;
use DB;
use Input;
use Redirect;

class ShakeController extends Controller {

	public function __construct()
	{
		date_default_timezone_set('Asia/Shanghai');
	}

	public function enter()
	{
		if(time() > strtotime('2015-02-22 20:34')) {
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
		return 50;
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