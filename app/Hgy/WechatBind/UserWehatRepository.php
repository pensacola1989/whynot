<?php namespace Hgy\WechatBind;

use Hgy\Core\EntityRepository;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/14/15
 * Time: 12:56 AM
 */

class UserWehatRepository extends EntityRepository {

    public function __construct(UserWechatBind $model)
    {
        $this->model = $model;
    }

    /** 用户与组织的关联表
     * @param $openid
     * @param $orgId
     * @return bool
     */
    public function UserBindOrg($openid, $orgId)
    {
        $hgyUser = $this->UserReigsterHGY($openid);
        if($hgyUser == null)
            return false;

        return $hgyUser->JoinedOrgs()->where('org_id', '=', $orgId)->first();
    }

    /** openid对应用户UserBase表
     * @param $openid
     * @return mixed
     */
    public function UserReigsterHGY($openid)
    {
        return $this->model
                    ->where('openid', '=', $openid)
                    ->first()
                    ->User;
    }

    public function isUserBindOrg($openid, $orgId)
    {
        return $this->UserBindOrg($openid, $orgId) != null;
    }

}