<?php namespace Hgy\Wechat;

use Auth;
use Hgy\Core\EntityRepository;

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

    public function getOrgChannel()
    {
        return $this->currentUser->Orgs()->first()->Channel;
    }

}