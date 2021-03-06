<?php namespace Hgy\Wechat;

use Illuminate\Support\Facades\App;
// use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/16/15
 * Time: 5:04 PM
 */


class WechatHelper {

    /**
     * @var 微信客户端
     */
    private $wechatClient;

    /**
     * 回调地址
     */
    public $rediret_url;

    public function __construct ()
    {
        $credentails = $this->getWechatCredentailByOrgId($this->getOrgId());
        $this->wechatClient = new WeChatClient($credentails->appid, $credentails->appsecret);
//        $this->wechatClient = new WeChatClient('wx236de42b1edcd623', '8d6c2cd8e8c3db33bc51541e1f31e09d');
        $this->rediret_url = URL::action('mobile\WechatAuthController@redirectForWechat');
    }

    /**
     *  获取openId
     */
    public function getOpenId()
    {
        if(Session::has('openid')) {
            return Session::get('openid');
        }
        return -1;
    }

    public function generateOauthUrl()
    {
        return $this->wechatClient->getOAuthConnectUri($this->rediret_url, 3);
    }
    
    /**
     * getOpenId方法会跳转到这个方法（如果需要到话），通过路由
     * 通过Oauth拿openid
     * @param $code
     * @return int
     */
    public function getOpenidByOauth($code)
    {
        if(!empty($code)) {
            $ret = $this->wechatClient->getAccessTokenByCode($code);
            return $ret != null ? $ret['openid'] : -1;
        }
        return -1;
    }

    /**
     * 获得组织id，以后改变此方法的位置
     * 判断路由参数，有orgId的直接拿，没有的通过activityid拿
     */
    public function getOrgId()
    {
        if(Session::has('current_org_id'))
            return Session::get('current_org_id');

        $parameters = Route::current()->parameters();
        if(isset($parameters['orgId'])) {
            Session::put('current_org_id', $parameters['orgId']);
            return $parameters['orgId'];
        }
        else {

            $orgId = App::make('\Hgy\Activity\ActivityRepository')
                        ->getOrgIdByActivityId($parameters['activity_id']);
            Session::put('current_org_id', $orgId);
            return $orgId;
        }

    }

    private function getWechatCredentailByOrgId($orgId)
    {
        $repo = App::make('\Hgy\Account\UserRepository');
        return $repo->getOrgWechatCredentail($orgId);
    }

    public function generateMenu($menuJson)
    {
        $this->wechatClient->setMenu($menuJson);
    }
}