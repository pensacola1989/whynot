<?php namespace whynot;

use Controller;
use View;

class ShakeController extends Controller {


	public function index()
	{
		return View::make('whynot.shake');
	}
}