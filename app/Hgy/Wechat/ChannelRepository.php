<?php namespace Hgy\Wechat;

use Auth;
use Hgy\Core\EntityRepository;
use Hgy\Platform\SnsInfo;
use Illuminate\Support\Facades\URL;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/16/15
 * Time: 1:38 AM
 */

class ChannelRepository extends EntityRepository {

    /** 当前后台管理员信息
     * @var
     */
    private $currentUser;

    public function __construct(Channel $model)
    {
        $this->model = $model;
        $this->currentUser = Auth::user();
    }

    /** 存储微信渠道信息
     * @param $channelInfos
     * @return mixed
     */
    public function saveWechatChannel($channelInfos)
    {
        $channelInfos['orgid'] = $this->currentUser->Orgs()->first()->id;
        $newOjb = $this->getNew($channelInfos);
        $this->currentUser->Orgs()->first()->Channel()->save($newOjb);
        return $newOjb;
    }

    /** 更新微信渠道信息
     * @param $id
     * @param $channelInfos
     */
    public function updateWechatChannel($id, $channelInfos)
    {
        return $this->currentUser
                    ->Orgs()
                    ->first()
                    ->Channel()
                    ->find($id)
                    ->update($channelInfos);
    }

    /** 获得某个组织下的微信渠道信息
     * @return mixed
     */
    public function getOrgChannel()
    {
        return $this->currentUser->Orgs()->first()->Channel;
    }

    /** 获取微信的回调地址和token
     * @return array
     */
    public function generateWechatUrlAndToken()
    {
        $orgId = $this->currentUser->Orgs()->first()->id;
        $urlBase = URL::route('wechatEnter');
        return ['callback_url'   =>  $urlBase . '/' . $orgId, 'token'    =>  '1989'];
    }

    public function saveSnsKeyInfo($inputs)
    {
        $data = json_encode($inputs);
        $newSnsInfo = new SnsInfo();
        $newSnsInfo->sns_key_info = $data;

        return $this->currentUser
                    ->Orgs()
                    ->first()
                    ->SnsInfo()
                    ->save($newSnsInfo);
    }

    public function updateSnsKeyInfo($inputs)
    {
        $data = json_encode($inputs);
        return $this->currentUser
                    ->Orgs()
                    ->first()
                    ->SnsInfo()
                    ->update([
                        'sns_key_info'  =>  $data
                    ]);
    }

    public function getSnsKeyInfo()
    {
        $org = $this->currentUser->Orgs()->first();
        return $org->SnsInfo;
    }

    // --------------------- for wechat frontend--------------------

}