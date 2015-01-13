<?php namespace Hgy\WechatBind;
use Hgy\Account\User;
use Hgy\Core\Entity;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/14/15
 * Time: 12:46 AM
 */

class OrgWechatBind extends Entity {

    protected $table = 'org_bind';

    protected $guarded = [];

    public function Org()
    {
        return $this->belongsTo(User::class, 'org_id');
    }
}