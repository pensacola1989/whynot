<?php namespace mobile;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Hgy\Wechat\WechatHelper;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/16/15
 * Time: 6:00 PM
 */

class WechatAuthController extends WechatMobileController {

    private $wechatHelper;

    public function __construct(WechatHelper $wechatHelper)
    {
        $this->wechatHelper = $wechatHelper;
    }

    public function redirectForWechat()
    {
        $code = Input::get('code');
        $openid = $this->wechatHelper->getOpenidByOauth($code);
        if($openid != -1) {
            Session::set('openid', $openid);
            return $this->redirectTo(URL::route('mobile\WcVltController@index', Session::get('current_org_id')));
        }
    }
}