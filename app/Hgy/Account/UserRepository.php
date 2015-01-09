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

     public function getTotalCompleteActivities($uid)
     {
        return $this->model->find($uid)->Activities()
                                        ->where('status', '=', 1)
                                        ->count();

     }

     public function getTotalVolunteers($uid)
     {
         return $this->model->find($uid)
                             ->CVolunteers()
                             ->count();
     }

     public function getUserInfoByUid($uid)
     {
         return UserInfo::where('uid', '=', $uid)
                            ->first();
     }

     public function searchOrgs($orgName, $type)
     {
         $searchChain = UserInfo::where('u_username', 'LIKE', '%'. $orgName .'%');

         if(!empty($type) && $type != '')
             $searchChain->where('u_pw_industry', '=', $type);

         return $searchChain->get();
     }

     private function _setDefaultRole(User $user)
     {
        $role = \App::make('Hgy\ACL\Role')->getDefaultRole();
         $user->attachRole($role);
     }
}