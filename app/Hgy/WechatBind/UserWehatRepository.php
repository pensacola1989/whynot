<?php namespace Hgy\WechatBind;

use App;
use Hgy\Account\User;
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
     * @param $uid
     * @param $orgId
     * @internal param $openid
     * @return bool
     */
    public function UserBindOrg($uid, $orgId)
    {
        $hgyUser = $this->UserReigsterHGY($uid);
        if($hgyUser == null)
            return false;

        return $hgyUser->JoinedOrgs()->where('org_id', '=', $orgId)->first();
    }

    /** openid对应用户UserBase表
     * @param $uid
     * @internal param $openid
     * @return mixed
     */
    public function UserReigsterHGY($uid)
    {
        $model= $this->model
                    ->where('uid', '=', $uid)
                    ->first();
        return $model != null ? $model->User : null;
    }

    /** 判断某个微信用户是否绑定到公益组织
     * @param $uid
     * @param $orgId
     * @internal param $openid
     * @return bool
     */
    public function isUserBindOrg($uid, $orgId)
    {
        return $this->UserBindOrg($uid, $orgId) != null;
    }

    public function bindUserToOrg($openid, $orgId, $userBaseCredential)
    {
        // 1.如果用户基础凭据在userbase里存在，无需新增纪录（取得uid）

        // 3.将获得的uid与orgid绑定
        $userBaseRepo = App::make('Hgy\Account\UserBaseRepository');
        $userBaseModel = $userBaseRepo->getUserBaseByCredentails($userBaseCredential);
        if($userBaseModel) {
            return $this->saveOpenIdAndAttachOrg($openid, $userBaseModel, $orgId);
            // 在openid_uid的map表里新增一条纪录
//            $newObj = $this->getNew([
//                'openid'    =>  $openid,
//                'uid'       =>  $userBaseModel->id
//            ]);
//            $this->save($newObj);
//            // 并且在user_volunteer表里新增一条map纪录，可能分表处理会有问题
//            $userBaseModel->BelongOrgs()->attach($orgId);

        } else {
            // 2.否则，新增一条纪录，取得uid
            $newUserBaseModel = $userBaseRepo->getNew([
                'username'  =>  $userBaseCredential['userName'],
                'email'     =>  $userBaseCredential['userEmail'],
                'mobile'    =>  $userBaseCredential['userMobile'],
                'password'  =>  'password01'
            ]);
            $newUserBaseModel::$rules['password'] = '';
            $newUserBaseModel::$rules['password_confirmation'] = '';
            $userBaseRepo->save($newUserBaseModel);
            return $this->saveOpenIdAndAttachOrg($openid, $newUserBaseModel, $orgId);

        }
    }

    /** 在openid_uid的map表里新增一条纪录，并且在user_volunteer表里新增一条map纪录，可能分表处理会有问题
     * @param $openid
     * @param $userBaseModel
     * @param $orgId
     * @internal param $uid
     */
    public function saveOpenIdAndAttachOrg($openid, $userBaseModel, $orgId)
    {
        $newObj = $this->getNew([
            'openid'    =>  $openid,
            'uid'       =>  $userBaseModel->id
        ]);
        $this->save($newObj);
        $userBaseModel->BelongOrgs()->attach($orgId);
        return $userBaseModel;
    }

    /** 通过openid去换uid
     * @param $openid
     * @return int
     */
    public function getUidByOpenid($openid)
    {
        $model = $this->model->where('openid', '=', $openid)->first();
        return $model == null ? -1 : $model->uid;
    }

    /** 保存组织需要用户填写的字段信息json
     * @param $orgId
     * @param $uid
     * @param $infos
     */
    public function saveUserCustomizeInfo($orgId, $uid, $infos)
    {
        $orgModel = User::find($orgId)
                        ->VltValues()
                        ->attach($uid, ['value' =>  $infos]);
    }

    /** 更新用户自定义信息
     * @param $orgId
     * @param $uid
     * @param $infos
     */
    public function updateUserCustomizeInfo($orgId, $uid, $infos)
    {
        return User::find($orgId)->VltValues()->updateExistingPivot($uid, $infos);
    }
}