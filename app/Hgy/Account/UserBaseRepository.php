<?php namespace Hgy\Account;

use Hgy\Core\EntityRepository;
use Illuminate\Support\Facades\Hash;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 12/7/14
 * Time: 2:32 AM
 */

class UserBaseRepository extends EntityRepository {

    public function __construct(UserBase $model)
    {
        $this->model = $model;
    }

    public function storeData($data)
    {
        $user = $this->getNew($data);
        $ret = $this->save($user);
        if(!$ret)  {
            $this->errorMessage = $user->errors();
        } else {
//            $this->_setDefaultRole($user);
            return $user;
        }
    }

    public function getError()
    {
        return $this->errorMessage;
    }

    public function saveUserInfo($uid)
    {

    }

    public function GetOrgByLoginEmail($email)
    {
        $userBase = $this->model->where('email', '=',  $email)->first();
        return $userBase;
    }

    private function _setDefaultRole(User $user)
    {
//        $role = \App::make('Hgy\ACL\Role')->getDefaultRole();
//        $user->attachRole($role);
    }

}