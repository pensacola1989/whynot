<?php namespace Hgy\Wechat;

use Illuminate\Support\Facades\Redirect;
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
    private $rediret_url;

    public function __construct ()
    {
        $this->wechatClient = new WeChatClient('wx236de42b1edcd623', '8d6c2cd8e8c3db33bc51541e1f31e09d');
        $this->rediret_url = URL::action('mobile\WechatAuthController@redirectForWechat');
    }

    /**
     *  获取openId
     */
    public function getOpenId()
    {
        if(Session::get('openid') != null)
            return Session::get('openid');
        $requestOauthUrl = $this->wechatClient->getOAuthConnectUri($this->rediret_url, 3);
        return Redirect::to($requestOauthUrl);
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
            return $ret->openid;;
        }
        return -1;
    }
}