<?php namespace Hgy\Wechat;
use Hgy\Core\Entity;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/16/15
 * Time: 1:37 AM
 */

class Channel extends Entity {

    protected $table = 'channel';

    public $timestamps = false;

    public static $rules = array(
        'appid'	=> 'required',
        'appsecret' => 'required',
        'token' =>  'required'
    );

    protected $guarded = [];

}