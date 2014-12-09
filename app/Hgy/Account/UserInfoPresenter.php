<?php namespace Hgy\Account;
use McCool\LaravelAutoPresenter\BasePresenter;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 12/9/14
 * Time: 12:33 AM
 */
class UserInfoPresenter extends BasePresenter {

    public function __construct(UserInfo $model)
    {
        $this->resource = $model;
    }
}