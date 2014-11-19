<?php namespace Hgy\ACL;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 4:01 PM
 */
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole {

    /**
     * default role for new user
     */
    const DEFAULT_ROLE_NAME = '公益组织';

    public static $rules = array(
        'name'				=> 'required|between:1,16',
    );

    public function getDefaultRole()
    {
        return self::where('name', '=', self::DEFAULT_ROLE_NAME)->first();
    }
}
