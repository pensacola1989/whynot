<?php namespace Hgy\WechatBind;

use Hgy\Account\UserBase;
use Hgy\Core\Entity;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/14/15
 * Time: 12:34 AM
 */

class UserWechatBind extends Entity {

    public $timestamps = false;

    protected $table = 'wechat_userbase';

    protected $guarded = [];

    /**
     * 多个openid对应一个uid
     */
    public function User()
    {
        return $this->belongsTo(UserBase::class, 'uid');
    }

}