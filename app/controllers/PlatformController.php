<?php
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/28/14
 * Time: 1:21 AM
 */
use Hgy\Account\UserRepository;

class PlatformController extends BaseController {

    protected $layout = 'layouts.home';

    private $userRepository;

    private $platFormRepsitory;

    public function __construct(UserRepository $userRepository, \Hgy\Platform\PlatformRepository $platformRepository)
    {
        $this->userRepository = $userRepository;
        $this->platFormRepsitory = $platformRepository;
    }

    /**
     * 获取公益组织用户
     */
    public function GetOrgUsers()
    {

    }

    public function orgmanager($isVerify=null)
    {
        $this->title = '组织管理';
        $totalCount = $this->platFormRepsitory->getOrgCount();
        $Orgs = $this->platFormRepsitory->getAllOrgsPaginate($isVerify);
        $verifyCount = $this->platFormRepsitory->getVerifyOrgCount();
        $this->view('platform.mgr_org',compact('Orgs', 'isVerify', 'totalCount', 'verifyCount'));
    }

    public function activityManager($isVerify=null)
    {
        $this->title = '管理组织活动';
        $activityManager = $this->platFormRepsitory->getAllActivitiesPaginate($isVerify);
        $this->view('platform.mgr_activity',compact('isVerify', 'activityManager'));
    }

    public function verifyAt()
    {
        $type = Input::get('type');
        $ids = Input::get('ids');

        if(!count($ids))
            return ['errorCode' =>  102, 'message'  =>  '操作失败'];

        $this->platFormRepsitory->updateActivityStatusBatch($ids, ['is_verify'  =>  intval($type)]);
        return ['errorCode' =>  0,  'message'   =>  '操作成功'];
    }

    public function verifyOrg()
    {
        $type = Input::get('type');
        $ids = Input::get('ids');

        if(!count($ids))
            return ['errorCode' =>  102, 'message'  =>  '操作失败'];

        $this->platFormRepsitory->updateOrgStatusBatch($ids, intval($type));
        return ['errorCode' =>  0,  'message'   =>  '操作成功'];
    }
}