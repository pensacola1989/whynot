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
    return View::make('home');
});
Route::get('/test','HomeController@getShow');
Route::get('/page', 'HomeController@getPage');


Route::post('/user/login', 'AuthController@login');


Route::group(['before' => 'guest'], function () {
    Route::get('/user/login','AuthController@getLogin');
    Route::get('/user/register/{step?}/{uid?}', 'UserController@register');
    Route::post('/user/register/{step?}/{uid?}', 'UserController@add');
});

Route::group(['before'  =>  'auth'], function () {
    /*
     * Accounts
     */

    Route::get('/user/logout','AuthController@Logout');

    // dashboard
    Route::get('/user/index', 'UserController@index');

    /*
     * Activity
     */
    Route::get('/activity/show/{userid}', 'ActivityController@index');
    Route::get('/activity/new', 'ActivityController@new');
    Route::get('/activity/update', 'ActivityController@edit');
    Route::post('/activity/add', 'ActivityController@add');

    /*
     * VolunteerGroup
     */
    Route::get('/volgroup', 'VolgroupController@GetGroup');
    Route::get('/volgroup/post/{id?}', 'VolgroupController@PostShow');
    Route::post('/volgroup/edit', 'VolgroupController@PostEdit');
    Route::post('/volgroup/post', 'VolgroupController@PostGroup');
    Route::post('/volgroup/delete',['as' => 'deletegroup', 'uses' =>  'VolgroupController@PostDelete']);

    /*
     * Volunteer
     */
    Route::get('/volteer', 'VolunteerController@GetVolunteers');
    Route::get('/volteer/info' , 'VlrInfoController@VolunteerInfo');
    Route::get('/volteer_s', 'VolunteerController@GetVolSearch');
    Route::post('/volteer/lock', ['as' => 'lockvlt', 'uses' =>  'VolunteerController@LockVolunteer']);
    Route::post('/volteer/batch', ['as' => 'batch', 'uses' => 'VolunteerController@BatchControl']);
});

Route::get('/seedVolteer',function() {
    $faker = Faker\Factory::create();
//    echo Faker\Provider\;exit();

    foreach(range(1, 10) as $index)
    {
        Hgy\Volunteer\Volunteer::create([
            'volunteer_name'	=>	str_replace('.', '_', $faker->unique()->name),
            'volunteer_mobile'	=>	Faker\Provider\PhoneNumber::phoneNumber(),
            'volunteer_email'	=>	$faker->email,
            'is_verify'         =>  0,
            'volunteer_interest'=>  'soccer',
            'org_id'            =>  1,
            'groupd_id'         =>  2
        ]);
    }
});

//Route::get('/seedACL', function() {
//
////    add role
//    $org = new Hgy\ACL\Role;
//    $org->name = '公益组织';
//    $org->save();
//
//    $thirdPlatform = new Hgy\ACL\Role;
//    $thirdPlatform->name = '第三方平台';
//    $thirdPlatform->save();
//
//    $globalPlat = new Hgy\ACL\Role();
//    $globalPlat->name = '平台方';
//    $globalPlat->save();
////    add permision
//    $platformPermission = new Hgy\ACL\Permission;
//    $platformPermission->name = 'manage_platform';
//    $platformPermission->display_name = '平台权限';
//    $platformPermission->save();
//
//    $manageOrg = new Hgy\ACL\Permission;
//    $manageOrg->name = 'manage_org';
//    $manageOrg->display_name = '组织管理';
//    $manageOrg->save();
//
//    $manageVolunteer = new Hgy\ACL\Permission;
//    $manageVolunteer->name = 'manage_volunteer';
//    $manageVolunteer->display_name = '志愿者管理';
//    $manageVolunteer->save();
//
//    $org->perms()->sync(array($manageVolunteer->id));
//    $globalPlat->perms()->sync(array($platformPermission->id));
////
////    $u->perms()->sync(array($manageOrg->id,$manageUser->id));
//
//    // return $u->hasRole('Owner') . '----' . $u->hasRole('Admin');
//});


Route::get('/validate',function() {
    $userinfo = new Hgy\Account\UserInfo();
    $userinfo->u_cp_unit = '';
    if(!$userinfo->validate()) {
        return $userinfo->errors();
    }
});

Route::get('seedVlrAttr', function() {
    $faker = Faker\Factory::create();


    foreach(range(1, 10) as $index)
    {
        Hgy\VltField\VltAttribute::create([
            'attr_name'	=>	$faker->firstName,
            'attr_field_name'	=>	$faker->word,
            'attr_des'	=>	$faker->text(),
            'attr_type' => $faker->numberBetween(0,10),
            'attr_extra'    => '',
            'attr_default_val'  =>  '',
            'attr_remark'   =>  '',
            'is_must'   =>  1,
            'sort_number'   =>  0,
            'vol_id'    =>  1,
            'validate_rule' =>  '',
            'is_active' =>  1,
            'is_init'   =>  1
        ]);
    }
});
