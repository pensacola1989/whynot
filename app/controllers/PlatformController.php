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

    public function activitymanager()
    {
        $this->title = '管理组织活动';
        $this->view('platform.mgr_activity');
    }

    public function orgmanager($isVerify=null)
    {
        $this->title = '组织管理';
        $Orgs = $this->platFormRepsitory->getAllOrgsPaginate($isVerify);
        $this->view('platform.mgr_org',compact('Orgs', 'isVerify'));
    }

    public function verifyOrg()
    {
        $ids = Input::get('ids');
        $this->platFormRepsitory->updateOrgStatusBatch($ids, 1);
    }

    public function notVerifyOrg()
    {
        $ids = Input::get('id');
        $this->platFormRepsitory->updateOrgStatusBatch($ids, 0);
    }
}