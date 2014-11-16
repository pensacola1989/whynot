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
//    echo 'welcome to laravel !';
//
//		// print_r($faker);exit();
		$faker = Faker\Factory::create('fr_FR');

		foreach(range(1, 10) as $index)
		{
			Hgy\Test\Test::create([
				'name'	=>	str_replace('.', '_', $faker->unique()->name),
				'title'	=>	$faker->userName,
                'testname'  =>  $faker->userName,
				'email'	=>	$faker->email
			]);
		}
	// return View::make('hello');
});
Route::get('/test','HomeController@getShow');
Route::get('/page', 'HomeController@getPage');
Route::get('/testacl', function() {
//    $owner = new Hgy\ACL\Role;
//    $owner->name = 'Owner';
//    $owner->save();
//
//    $admin = new Hgy\ACL\Role;
//    $admin->name = 'Admin';
//    $admin->save();
    $adminRole = Hgy\ACL\Role::where('name','=','Admin')->first();
    $user = Hgy\Account\User::where('orgName','=','testOrg')->first();
//    return Config::get('entrust::role') . '___' .  Config::get('entrust::assigned_roles_table');
//    return $user->roles;
//    $user->attachRole($adminRole);
});