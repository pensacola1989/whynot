<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('/user/login');
		}
	}
});

Route::filter('mobile-auth', function()
{
    if (Auth::guest())
    {
        if (Request::ajax())
        {
            return Response::make('Unauthorized', 401);
        }
        else
        {
            return Redirect::guest('/user/login');
        }
    }
});

Route::filter('wechat-bind', function() {
    // 测试openid

    $wechatHelper = App::make('\Hgy\Wechat\WechatHelper');

    $openid = $wechatHelper->getOpenId();

    if($openid != null) \Illuminate\Support\Facades\Session::set('openid', $openid);


    $orgId = $wechatHelper->getOrgId();
//    if($orgId != null) \Illuminate\Support\Facades\Session::set('current_org_id', $orgId);

    $openid = $wechatHelper->getOpenId();
//    if($openid != null) \Illuminate\Support\Facades\Session::set('openid', $openid);

    $bindRepo = App::make('\Hgy\WechatBind\UserWehatRepository');

    $uid = $bindRepo->getUidByOpenid($openid);
    if(!$uid) return Redirect::route('get_join_org', ['orgId'=>$orgId]);
    $isBind = $bindRepo->UserBindOrg($uid, $orgId) != null;
    if(!$isBind) return Redirect::route('get_join_org', ['orgId'=>$orgId]);
});

Route::filter('bind-page', function() {
    $requestUrl = Request::fullUrl();
    \Illuminate\Support\Facades\Session::set('redirect_url', $requestUrl);
    App::make('\Hgy\Wechat\WechatHelper')->getOpenId();
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/user/index');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
