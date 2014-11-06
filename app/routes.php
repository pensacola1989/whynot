<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{

		$faker = Faker\Factory::create('fr_FR');
		// print_r($faker);exit();

		foreach(range(1, 10) as $index)
		{
			Hgy\Test\Test::create([
				'name'	=>	str_replace('.', '_', $faker->unique()->name),  
				'title'	=>	$faker->userName,
				'email'	=>	$faker->email
				// 'body'	=>	Text::realText($maxNbChars = 200, $indexSize = 2)
			]);
		}
	// return View::make('hello');
});
Route::get('/test','HomeController@getShow');