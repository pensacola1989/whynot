<?php
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/20/14
 * Time: 11:02 PM
 */

namespace Hgy\Account;

use McCool\LaravelAutoPresenter\PresenterInterface;
use Hgy\Core\Entity;


class UserInfo extends Entity implements PresenterInterface{

    protected $table = 'userinfo';

    protected $guarded = [];
    /**
     * Get the presenter class.
     *
     * @return string The class path to the presenter.
     */

    public static $rules = array(
        'u_cp_unit'             => 'required|between:1,50',
        'u_pw_industry'         => 'required|between:1,50',
        'u_province'            => 'required|between:1,50',
        'u_address'             => 'required|between:1,150',
        'u_postcode'            => 'numeric',
        'u_teamsize'            => 'numeric',
        'u_target_area'         => 'required|between:1,50',
        'u_target_people'       => 'required|between:2,50',
        'u_username'            => 'required|between:2,50',
        'u_mobile'              => 'required|between:11,15',
        'u_other_contact'       => 'required|between:1,50'
    );

    public static $customMessages = [
        'required'  =>  '请填写所有字段',
        'numeric'   =>  '请填写数字类型'
    ];

    public function getPresenter()
    {
        return UserInfoPresenter::class;
    }
}