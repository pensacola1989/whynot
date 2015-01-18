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
use Hgy\Wechat\WechatHelper;
use Hgy\Account\UserBaseRepository;
use Hgy\Activity\ActivityRepository;

class WcVltController extends WechatMobileController {

    private $organization;

    private $userBase;

    private $activity;

    private $wechatHelper;

    protected $layout = 'layouts.mobilelayout';
//    protected $layout = 'layouts.hgy_layout';

    public function __construct(UserBaseRepository $userBaseRepository,
                                ActivityRepository $activityRepository,
                                UserRepository $userRepository,
                                WechatHelper $wechatHelper)
    {
        parent::__construct();
        $this->userBase = $userBaseRepository;
        $this->activity = $activityRepository;
        $this->organization = $userRepository;
        $this->wechatHelper = $wechatHelper;
    }

    /**
     * 微信端志愿者主页 for 哈公益
     */
    public function index()
    {
        $this->title = '志愿者主页';
        $this->header = false;
        // $uid = $this->getUidForHgy();
        $isLogin = $uid != -1;
        $uid = $this->getUid();
        $userActivities = !$isLogin ? 0 : $this->userBase->getActivitiesUidAndOrgId($uid, $this->orgId);
        $userData = $this->userBase->requireById($uid);
        $userComments = !$isLogin ? 0 : $this->userBase->getCommentsByUidAndOrgId($uid, $this->orgId);
        $totalTime = !$isLogin ? 0 : $this->userBase->getTotalTimeByUidAndOrgId($uid, $this->orgId);
        $orgId = $this->orgId;

        $this->view('mobile.org_vlt_index',
            compact('userComments', 'userData', 'userActivities', 'totalTime', 'orgId'));
    }

    /** 用户对某个组织对活动参加历史
     * @param $orgId
     * @param $type
     */
    public function userActivityHistory($orgId, $type)
    {
        $this->title = $type == 1 ? '参加活动历史' : '您的评价历史';
        $this->header = false;
        if($type == 1) { // 参加活动对历史
            $activities = $this->userBase->getActivitiesUidAndOrgId($this->getUid(), $orgId);
        } elseif($type == 0) { // 评价历史
            $activities = $this->userBase->getCommentsByUidAndOrgId($this->getUid(), $orgId);
        }
        $this->view('mobile.user_history', compact('activities', 'type'));
    }
}