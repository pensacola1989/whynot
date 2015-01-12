<?php namespace mobile;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/13/15
 * Time: 1:10 AM
 */


use Auth;
use Hgy\Account\UserRepository;
use Input;
use Hgy\Account\UserBaseRepository;
use Hgy\Activity\ActivityRepository;

class WcVltController extends WechatMobileController {

    private $organization;

    private $userBase;

    private $activity;

    protected $layout = 'layouts.mobilelayout';
//    protected $layout = 'layouts.hgy_layout';

    public function __construct(UserBaseRepository $userBaseRepository,
                                ActivityRepository $activityRepository,
                                UserRepository $userRepository)
    {
        parent::__construct();
        $this->userBase = $userBaseRepository;
        $this->activity = $activityRepository;
        $this->organization = $userRepository;
    }

    /**
     * 微信端志愿者主页 for 哈公益
     */
    public function index()
    {
        $this->title = '志愿者主页';
        $this->header = false;
        $uid = $this->getUid();
        $isLogin = Auth::check();
        $activityCount = !$isLogin ? 0 : $this->userBase->getActivityCountByUidAndOrgId($uid, $this->orgId);
        $userData = $this->userBase->requireById($uid);
        $commentCount = !$isLogin ? 0 : $this->userBase->getCommentCountByUidAndOrgId($uid, $this->orgId);
        $totalTime = !$isLogin ? 0 : $this->userBase->getTotalTimeByUidAndOrgId($uid, $this->orgId);

        $this->view('mobile.org_vlt_index',
            compact('commentCount', 'userData', 'activityCount', 'totalTime'));
    }
}