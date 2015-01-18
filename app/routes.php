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
/*
|--------------------------------------------------------------------------
| 平台方
|--------------------------------------------------------------------------
| 平台方路由
|
*/

Route::any('/weixin', function() {
//    $wechatServer = new \Hgy\Wechat\WeChatServer(1989);
    return \Illuminate\Support\Facades\Redirect::to('/redirect');
});

Route::any('/redirect', 'mobile\WechatAuthController@redirectForWechat');

Route::get('/test2', function() {
    header("Content-type: application/json; charset=utf-8");
    dd(Hgy\Account\User::with(['Admins', 'userinfos'])->where('is_verify', '=', 1)->get());
});

Route::get('/wechat', function() {
    \Hgy\Wechat\WeChatServer::getXml4ImgByMid('xx');
});
//---------------------------------------------------------------------------
Route::get('/', function()
{
    return View::make('home');
});
Route::get('/test','HomeController@getShow');
Route::get('/page', 'HomeController@getPage');

Route::post('/user/login', 'AuthController@login');

Route::group(['before' => 'guest'], function () {

    Route::get('mobile/home/join/{orgId}', ['as'=>'get_join_org', 'uses'  =>  'mobile\HomeController@joinOrg']);

    Route::get('/user/login','AuthController@getLogin');
    Route::get('/user/register/{step?}/{uid?}', 'UserController@register');
    Route::post('/user/register/{step?}/{uid?}', 'UserController@add');

    Route::get('/org/register/{step?}/{uid?}', 'OrganizationController@register');
    Route::post('/org/register/{step?}/{uid?}', 'OrganizationController@add');
});
//----------------------------------移动端-----------------------------------------
Route::group(['before' => 'wechat-bind'], function() {
    Route::get('mobile/home/{orgId}',['uses'    =>  'mobile\HomeController@index']);

    Route::get('mobile/vlt/wc_index/{orgId}', ['uses'=>'mobile\WcVltController@index']);
    Route::get('mobile/vlt/history/user_attend/{orgId}/{type}', ['uses'=>'mobile\WcVltController@userActivityHistory']);
    Route::get('mobile/vlt/history/user_comment/{orgId}/{type}', ['uses'=>'mobile\WcVltController@userActivityHistory']);
    Route::get('mobile/vlt/u_attend_history/{orgId}', ['uses'=>'mobile\WcVltController@userAttendHistory']);
    Route::get('mobile/activity/latest/{orgId}',['uses'    =>  'mobile\WcActivityController@latest']);
    Route::get('mobile/activity/at_register/{activity_id}',['uses'    =>  'mobile\WcActivityController@atRegister']);
    Route::post('mobile/activity/at_register/{activity_id}',['as'=>'mobile_regat', 'uses'    =>  'mobile\WcActivityController@postAtRegister']);
    Route::get('mobile/activity/at_history/{orgId}', ['uses'    =>  'mobile\WcActivityController@atHistory']);

    Route::get('mobile/vlt/comment_at', ['uses' =>  'mobile\VolunteerController@commentAt']);
//    Route::get('mobile/vlt/comment_detail/{activityId}', ['uses' =>  'mobile\VolunteerController@commentDetail']);
//    Route::post('mobile/vlt/comment_detail/{activityId}', ['uses' =>  'mobile\VolunteerController@postComment']);
});

//Route::get('mobile/home/{orgId}',['uses'    =>  'mobile\HomeController@index']);
/**
 * 加入组织
 */
Route::group(['before'  =>  'bind-page'], function() {
    Route::get('mobile/home/join/{orgId}', ['uses'  =>  'mobile\HomeController@joinOrg']);
    Route::get('mobile/join/success', ['uses'   =>  'mobile\HomeController@joinSuccess']);
    Route::post('mobile/home/join/{orgId}', ['as'=>'join_org', 'uses'=>'mobile\HomeController@postJoinOrg']);
});


/**
 * 加入组织post请求
 */
//Route::post('mobile/home/join/{orgId}', ['as'=>'join_org', 'uses'=>'mobile\HomeController@postJoinOrg']);
/**
 * 活动
 */

//Route::get('mobile/vlt/wc_index/{orgId}', ['uses'=>'mobile\WcVltController@index']);
//Route::get('mobile/vlt/history/user_attend/{orgId}/{type}', ['uses'=>'mobile\WcVltController@userActivityHistory']);
//Route::get('mobile/vlt/history/user_comment/{orgId}/{type}', ['uses'=>'mobile\WcVltController@userActivityHistory']);
//Route::get('mobile/vlt/u_attend_history/{orgId}', ['uses'=>'mobile\WcVltController@userAttendHistory']);
//Route::get('mobile/activity/latest/{orgId}',['uses'    =>  'mobile\WcActivityController@latest']);
//Route::get('mobile/activity/at_register/{activity_id}',['uses'    =>  'mobile\WcActivityController@atRegister']);
//Route::post('mobile/activity/at_register/{activity_id}',['as'=>'mobile_regat', 'uses'    =>  'mobile\WcActivityController@postAtRegister']);
//Route::get('mobile/activity/at_history/{orgId}', ['uses'    =>  'mobile\WcActivityController@atHistory']);
//Route::get('mobile/vlt/index', ['as'    =>  'hgy_index', 'uses'  =>  'mobile\VolunteerController@index']);
//Route::get('mobile/vlt/comment_at', ['uses' =>  'mobile\VolunteerController@commentAt']);
Route::get('mobile/vlt/comment_detail/{activityId}', ['uses' =>  'mobile\VolunteerController@commentDetail']);
Route::post('mobile/vlt/comment_detail/{activityId}', ['uses' =>  'mobile\VolunteerController@postComment']);
/**
 * hagongyi对用户的页面
 */
Route::get('mobile/vlt/index', ['as'    =>  'hgy_index', 'uses'  =>  'mobile\VolunteerController@index']);
Route::get('mobile/hgy/vlt/info_modify', ['uses'    =>  'mobile\VolunteerController@infoModify']);
Route::post('mobile/hgy/vlt/info_modify/{uid}', ['uses'    =>  'mobile\VolunteerController@postInfoForHgyEdit']);
Route::get('mobile/hgy/vlt/at_history', ['uses'    =>  'mobile\VolunteerController@atHistory']);
Route::get('mobile/hgy/vlt/at_latest', ['uses'    =>  'mobile\VolunteerController@atLatest']);
Route::get('mobile/hgy/vlt/org_search', ['uses'    =>  'mobile\VolunteerController@orgSearch']);
Route::get('mobile/hgy/login', ['uses'    =>  'mobile\AuthController@loginToHgy']);
Route::get('mobile/hgy/register', ['uses'    =>  'mobile\AuthController@register']);
Route::post('mobile/hgy/register', ['as' =>  'mobile_reg', 'uses'   =>  'mobile\AuthController@postRegister']);
Route::post('mobile/hgy/login', ['as'   =>  'loginToHgy', 'uses'    =>  'mobile\AuthController@checkLogin']);

Route::get('mobile/hgy/mod_pass', ['as'=>'mod_pass', 'uses'=>'mobile\AuthController@updatePass']);
Route::post('mobile/hgy/check_pass', ['as'=>'check_pass', 'uses'=>'mobile\AuthController@checkPass']);
Route::post('mobile/hgy/update_pass', ['as'=>'update_pass', 'uses'=>'mobile\AuthController@postUpdatePass']);

Route::get('mobile/hgy/commentHistory/{needComment?}', ['uses'=>'mobile\VolunteerController@commentHistory']);
/*
 * 搜索
 */
Route::post('mobile/hgy/vlt/org_search', ['as'=>'org_search', 'uses'    =>  'mobile\VolunteerController@postSearch']);

//---------------------------------------------------------------------------


Route::group(['before'  =>  'auth'], function () {
    /**
     * Channel
     */
    Route::get('/channel/index', 'ChannelController@index');
    Route::post('/channel/new/{channelId?}', 'ChannelController@postChannelEdit');
    /*
     * Platform
     */
    Route::get('/platform/manager/user','PlatformController@UserManage');
//    Route::get('/pfmanager/activity', 'PlatformController@activitymanager');
    Route::get('/pfmanager/org/{isVerify?}', 'PlatformController@orgmanager');
    Route::get('/pfmanager/activity/{isVerify?}', 'PlatformController@activityManager');

    Route::post('/pfmanager/org', ['as' =>  'verifyorg', 'uses' =>  'PlatformController@verifyOrg']);
    Route::post('/pfmanager/at', ['as' =>  'verifyat', 'uses' =>  'PlatformController@verifyAt']);
    /*
     * Accounts
     */

    Route::get('/user/logout','AuthController@Logout');

    // dashboard
    Route::get('/user/index', 'UserController@index');

    /**
     * Activity Attributes
     */
    Route::get('/activity/infoEdit/{id?}' ,'ActivityController@editAtInfo');
    Route::post('/activity/postInfoEdit/{id?}', 'ActivityController@postEditInfo');
    Route::post('/activity/postSort', ['as' =>  'sortAt', 'uses'    =>  'ActivityController@postUpdateSort']);
    Route::post('/activity/postDelete', ['as'   =>  'deleteInfoAt', 'uses'  =>  'ActivityController@postDelete']);
    /**
     * Activity Register
     */
    Route::get('/activityreg/{activityId}', 'AtRegisterController@index');
    Route::post('/activityreg/{actvityId}', ['as' => 'approve', 'uses' => 'AtRegisterController@approveVlt']);
    /*
     * Activity
     */
    Route::post('/atpublish', ['as'  =>  'atpub',    'uses'  =>  'ActivityController@publishActivity']);
    Route::get('/activitysign/index/{activityId}', 'AtSignController@index');
    Route::get('/activity/index','ActivityController@index');
    Route::get('/activity/manage','ActivityController@manage');
//  public
//    Route::get('/activity/release','ActivityController@release');
    Route::get('/activity/publish/{step?}/{uid?}', 'ActivityController@publish');
    Route::post('/activity/publish/{step?}/{uid?}', 'ActivityController@add');
    Route::any('/upload/images','UploadController@uploadFile');

//    Route::get('/activity/summary','ActivityController@summary');
    Route::post('/summary/complete/{activityId}', ['as' =>  'postcomplete', 'uses'  =>  'AtSummaryController@postComplete']);
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
    Route::get('/group_user/{group_id}', 'VolunteerController@checkByGroup');
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

Route::get('seedAtAttr', function() {
    $fieldMap = ['datetime','text','enum','image'];

    $faker = Faker\Factory::create();

    foreach(range(1,10) as $index) {
        \Hgy\Activity\ActivityAttribute::create([
            'attr_name'	=>	$faker->firstName,
            'attr_field_name'	=>	$faker->word,
            'attr_des'	=>	$faker->text(),
            'attr_type' => $fieldMap[$faker->numberBetween(0,3)],
            'attr_extra'    => '',
            'attr_default_val'  =>  '',
            'attr_remark'   =>  '',
            'is_must'   =>  1,
            'sort_number'   =>  0,
            'activit_id'    =>  1,
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

Route::get('testimg', function() {

//    $imgRepo = new \Hgy\Image\ImageRepository(new \Hgy\Image\Image());
    $imgRepo = App::make('Hgy\Image\ImageRepository');
    $imgRepo->addImage('fuck');
});

Route::get('facade', function() {
    \Hgy\Facades\TemplateFunc::test();
});

Route::get('testopenid', function() {
//    return \Hgy\WechatBind\UserWechatBind::where('openid', '=', 'open234ijdf0')
//                        ->first()->User;
//    return \Hgy\Account\UserBase::find(20)->JoinedOrgs;
    $obj = new \Hgy\WechatBind\UserWehatRepository(new \Hgy\WechatBind\UserWechatBind());
    return $obj->UserBindOrg('open234ijdf0', 1);
});