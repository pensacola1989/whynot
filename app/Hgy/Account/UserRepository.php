<?php namespace Hgy\Account;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/18/14
 * Time: 9:34 PM
 */

 use Hgy\Core\EntityRepository;

class UserRepository extends EntityRepository {

//    private $errorMessage;

    public function __construct(User $model)
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
            $this->_setDefaultRole($user);
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

     private function _setDefaultRole(User $user)
     {
        $role = \App::make('Hgy\ACL\Role')->getDefaultRole();
         $user->attachRole($role);
     }


}