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

    Route::get('/org/register/{step?}/{uid?}', 'OrganizationController@register');
    Route::post('/org/register/{step?}/{uid?}', 'OrganizationController@add');
});

Route::group(['before'  =>  'auth'], function () {
    /*
     * Platform
     */
    Route::get('/platform/manager/user','PlatformController@UserManage');
    /*
     * Accounts
     */

    Route::get('/user/logout','AuthController@Logout');

    // dashboard
    Route::get('/user/index', 'UserController@index');
    /**
     * Activity Register
     */
    Route::get('/activityreg/{activityId}', 'AtRegisterController@index');
    Route::post('/activityreg/{actvityId}', ['as' => 'approve', 'uses' => 'AtRegisterController@approveVlt']);
    /*
     * Activity
     */
    Route::get('/activitysign/index/{activityId}', 'AtSignController@index');
    Route::get('/activity/index','ActivityController@index');
    Route::get('/activity/manage','ActivityController@manage');
//  public
//    Route::get('/activity/release','ActivityController@release');
    Route::get('/activity/publish/{step?}/{uid?}', 'ActivityController@publish');
    Route::post('/activity/publish/{step?}/{uid?}', 'ActivityController@add');

//    Route::get('/activity/summary','ActivityController@summary');
    Route::post('/summary/replytovol/{activityId}',['as'    =>  'replytovol', 'uses'   => 'AtSummaryController@atReplyToVol']);
    Route::post('/summary/editduration/{activityId}', ['as'  =>  'updateduration', 'uses'    =>  'AtSummaryController@postEditVolDuration']);
    Route::get('/summary/reply/{activityId}', 'AtSummaryController@Reply');
    Route::get('/summary/editsummary/{activityId}', 'AtSummaryController@editSummary');
    Route::post('/summary/postEditSummary/{activityId?}', 'AtSummaryController@postEditSummary');
    Route::get('/activity/summary','AtSummaryController@index');
    Route::get('/activity/show/{userid}', 'ActivityController@index');
    Route::get('/activity/new', 'ActivityController@new');
    Route::get('/activity/update', 'ActivityController@edit');
    Route::post('/activity/add', 'ActivityController@add');
    Route::post('/activity/homeSearch', 'ActivityController@homeSearch');

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
    Route::get('/volteer_s', 'VolunteerController@GetVolSearch');
    Route::post('/volteer/lock', ['as' => 'lockvlt', 'uses' =>  'VolunteerController@LockVolunteer']);
    Route::post('/volteer/batch', ['as' => 'batch', 'uses' => 'VolunteerController@BatchControl']);
    Route::get('/volteer/detail/{vlrId}', ['as' => 'vltdtl', 'uses' => 'VolunteerController@GetVltDetails']);
    /*
     * Volunteer Info
     */
    Route::get('/volteer/info' , 'VlrInfoController@index');
    Route::get('/vltinfo/addshow',  'VlrInfoController@addShow');
    Route::post('/vltinfo/edit/{id?}', 'VlrInfoController@postEdit');
    Route::get('/vltinfo/editshow/{id?}', 'VlrInfoController@editShow');
    Route::post('/vltinfo/delete' ,['as' => 'deleteAttr', 'uses' => 'VlrInfoController@postDelete']);
    Route::post('/vltinfo/sort', ['as' => 'savesort', 'uses' => 'VlrInfoController@postUpdateSort']);
});

Route::get('/seedVolteer',function() {

    $faker = Faker\Factory::create();
//    echo Faker\Provider\;exit();

    foreach(range(1, 10) as $index)
    {
        $ret = Hgy\Volunteer\Volunteer::create([
            'volunteer_name'	=>	str_replace('.', '_', $faker->unique()->name),
            'volunteer_mobile'	=>	Faker\Provider\PhoneNumber::phoneNumber(),
            'volunteer_email'	=>	$faker->email,
            'is_verify'         =>  0,
            'volunteer_interest'=>  'soccer',
            'org_id'            =>  1,
            'groupd_id'         =>  2
        ]);
        \Hgy\Account\User::find(1)->CVolunteers()->attach($ret->id,['group_id' =>  0]);
    }
});

Route::get('/seedatval', function() {

    $faker = Faker\Factory::create();

    foreach(range(1,23) as $index) {
        Hgy\Activity\ActivityAttributeValue::create([
            'uid'   =>  $index,
            'activity_id'   =>  1,
            'value'     =>  '[ name:"sdf"]'
        ]);
    }
});

Route::get('/testacl', function() {
    $currentUserRole = Auth::user()->roles;
    foreach($currentUserRole as $role) {
        echo $role->perms;
    }
});
Route::get('testpivot', function() {
    return \Hgy\Volunteer\Volunteer::find(15)->Organizations;
    $user = \Hgy\Volunteer\Volunteer::find(15)
                ->Organizations()
                ->where('org_id', Auth::user()->id)
                ->first();
    return $user->CVolunteers->pivot->group_id;
//    $ret = \Hgy\Account\User::find(1)->CVolunteers;
//    foreach($ret as $r) {
//        return $r->pivot->group_id;
//    }
//    return \Hgy\Account\User::find(1)->CVolunteers;
});
Route::get('/testuser', function() {
//    foreach(range(1,4) as $index) {
//        \Hgy\Account\User::find(1)->CVolunteers()->updateExistingPivot($index,['group_id'   =>  3]);
//    }
//    \Hgy\Account\User::find(1)->CVolunteers()->attachNew(['group_id' =>  6],[1,2,3,4]);
//    return 'done';
//    return \Hgy\Account\User::find(1)->CVolunteers()->updateExistingPivot([1,2,3],['group_id' =>  3]);
//    return \Hgy\Account\User::find(1)->CVolunteers()->whereIn('vol_id',[1,2,3])->get();
//    return \Hgy\Volunteer\::find()
//    return \Hgy\Account\User::find(1)->CVolunteers;
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

Route::get('/seedVlrDetail', function() {
    $faker = Faker\Factory::create();

    foreach(range(1, 11) as $index) {
        $value = new stdClass();
        $value->name = 'www';
        $value->age = $faker->numberBetween(18,30);
        $value->location = $faker->address;

        Hgy\VltField\VltAttributeValue::create([
            'vol_id'    =>  $index,
            'value'     =>  json_encode($value)
        ]);
        unset($value);
    }

});
Route::get('/validate',function() {
    $userinfo = new Hgy\Account\UserInfo();
    $userinfo->u_cp_unit = '';
    if(!$userinfo->validate()) {
        return $userinfo->errors();
    }
});

Route::get('seedVlrAttr', function() {
    $fieldMap = ['datetime','text','enum','image'];

    $faker = Faker\Factory::create();


    foreach(range(1, 10) as $index)
    {
        Hgy\VltField\VltAttribute::create([
            'attr_name'	=>	$faker->firstName,
            'attr_field_name'	=>	$faker->word,
            'attr_des'	=>	$faker->text(),
            'attr_type' => $fieldMap[$faker->numberBetween(0,3)],
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

Route::get('seedAt', function() {
    $faker = Faker\Factory::create();

    foreach(range(1,10) as $index) {
        Hgy\Activity\Activities::create([
            'bizid'    =>  1,
            'content'   =>  '欢迎参加活动' . $index,
            'channels'  =>  '1,2',
            'can_edit'  =>  0,
            'end_time'  =>  '2014-12-01 02:31:16',
            'is_verify' =>  0,
            'attend_num'    =>  10,
            'approve_num'   =>  5,
            'request_num'   =>  20,
            'cover'     =>  2,
            'finish_tip'    =>  '请准时参加',
            'title'     =>  '活动'.$index,
            'area'      =>  '上海',
            'start_time'    =>  time()
        ]);
    }
});
