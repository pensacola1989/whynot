<?php namespace mobile;

use Hgy\Wechat\WeChatServer;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/17/15
 * Time: 2:55 AM
 */

class WechatHandlerController extends WechatMobileController {

    private $wechatHandler;

    public function __construct()
    {
//        $this->wechatHandler = new WeChatServer('token');
    }

    /**
     * 接受微信消息
     */
    public function index()
    {
        $this->wechatHandler = new WeChatServer('token');
        // get message
    }
}