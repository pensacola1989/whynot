<?php namespace Hgy\Account;

use Hgy\Activity\Activities;
use Hgy\Activity\ActivityAttributeValue;
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

    /**
     * 参加的活动数 哈公益 总活动数
     * @param $uid
     * @return
     */
    public function getActivityCountByUid($uid)
    {
        return $this->model->find($uid)->attendActivities->count();
    }

    public function getActivitiesUidAndOrgId($uid, $orgId)
    {
        $model = $this->model->find($uid);
        if($model != null) {
            return $model->attendActivities()
                         ->whereHas('Activity', function ($q) use ($orgId) {
                            $q->where('bizid', $orgId);
                         })->get();
        }
        return null;
    }

    /**
     * 评价次数，不为空的视为已经评价  对哈公益的，所有组织的所有活动的评价数
     * @param $uid
     */
    public function getCommentCountByUid($uid)
    {
        return $this->model
                    ->find($uid)
                    ->attendActivities()
                    ->where('vol_reply', '!=', '')
                    ->count();
    }

    /** 志愿者对于某个组织的评价总数
     * @param $uid
     * @param $orgId
     * @return mixed
     */
    public function getCommentsByUidAndOrgId($uid, $orgId)
    {
        return $this->model->find($uid)
                            ->attendActivities()
                            ->whereHas('Activity', function ($q) use ($orgId) {
                                $q->where('bizid', $orgId);
                            })
                            ->where('vol_reply', '!=', '')
                            ->get();
    }


    /**
     * 获取志愿者的总时间
     * @param $uid
     */
    public function getTotalTimeByUid($uid)
    {
        return $this->model
                    ->find($uid)
                    ->attendActivities()
                    ->groupBy('uid')
                    ->sum('vol_duration');
    }

    public function getTotalTimeByUidAndOrgId($uid, $orgId)
    {
        return $this->model
                    ->find($uid)
                    ->attendActivities()
                    ->whereHas('Activity', function ($q) use ($orgId) {
                        $q->where('bizid', $orgId);
                    })
                    ->sum('vol_duration');
    }

    public function getError()
    {
        return $this->errorMessage;
    }


    /**
     * 检查是否为Email
     * @param $str
     * @return int
     */
    public function isEmail($str)
    {
        $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
        return preg_match( $pattern, $str );
    }

    public function isMobile($str)
    {
        return intval($str) && strlen($str) == 11;
    }



    public function saveUserInfo($uid)
    {

    }

    public function GetOrgByLoginEmail($email)
    {
        $userBase = $this->model->where('email', '=',  $email)->first();
        return $userBase;
    }

    public function updateUserBaseInfo($uid, $info)
    {
        $user = $this->model->find($uid);
        $user->email = $info['email'];
        $user->mobile = $info['mobile'];
        $user->username = $info['username'];
        $this->_ignoreRules($user);
        return $user->save();
    }

    public function updateUserPass($uid, $newPass)
    {
        $user = $this->model->find($uid);
        $user->password = $newPass;
        $this->_ignoreRules($user);
        return $user->save();
    }

    public function getUserAttendAtHistory($uid)
    {
        return User::whereHas('Activities', function($q) use ($uid) {
            $q->whereHas('Attendees', function($q) use ($uid) {
                $q->where('uid', '=', $uid);
            });
        })
        ->with(['Activities'  =>  function($q) use ($uid) {
            $q->whereHas('Attendees', function($q) use ($uid) {
                $q->where('uid', '=', $uid);
            });
        } ])->get();
//        return User::whereHas('Activities', function($q) use ($uid) {
//            $q->whereHas('Attendees', function($q) use ($uid) {
//                $q->where('uid', '=', $uid);
//            });
//        })->get();
//        $count =  User::with(['Activities' =>  function($q) use ($uid) {
//            $q->whereHas('Attendees', function($q) use ($uid) {
//                $q->where('uid', '=', $uid);
//            })->get();
//        }])->count();
//        echo $count;exit();
//        return User::with(['Activities' =>  function($q) use ($uid) {
//            $q->whereHas('Attendees', function($q) use ($uid) {
//                $q->where('uid', '=', $uid);
//            })->get();
//        }]);
//        return Activities::whereHas('Attendees', function($q) use ($uid) {
//            $q->where('uid', '=', $uid);
//        })->groupBy('bizid')->get();
    }

    private function _ignoreRules($user)
    {
        if ($user->exists)
        {
            $user::$rules['password'] = '';
            $user::$rules['password_confirmation'] = '';
        }
    }

    public function getUserCommentList($uid, $needComment)
    {
        $query = $this->model->find($uid)->attendActivities();
        if(intval($needComment) == 1)
            return $query->where('vol_reply', '=', null)->get();
        return $query->where('vol_reply', '!=', '')->get();
    }

    /** 通过手机和Email获得用户基础数据
     * @param $credential
     */
    public function getUserBaseByCredentails($credential)
    {
        return $this->model->where('mobile', '=', $credential['userMobile'])
                            ->orWhere('email', '=', $credential['userEmail'])
                            ->first();
    }

    private function _setDefaultRole(User $user)
    {
//        $role = \App::make('Hgy\ACL\Role')->getDefaultRole();
//        $user->attachRole($role);
    }

}