<?php  namespace Hgy\Wechat\Facades;

use Illuminate\Support\Facades\Facade;

class WeChatClient extends Facade {

    protected static function getFacadeAccessor() { return 'wechatclient'; }

}