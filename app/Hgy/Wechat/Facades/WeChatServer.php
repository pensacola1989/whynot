<?php
namespace Hgy\Wechat\Facades;



use Illuminate\Support\Facades\Facade;
class WeChatServer extends Facade {

    protected static function getFacadeAccessor() { return 'wechatserver'; }

}