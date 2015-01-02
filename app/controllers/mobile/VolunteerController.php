<?php namespace mobile;

use Auth;
use Hgy\Account\UserBaseRepository;
use Hgy\Activity\ActivityRepository;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 12/25/14
 * Time: 12:33 AM
 */

class VolunteerController extends \BaseController {

    private $userBase;

    private $activity;

    protected $layout = 'layouts.mobilelayout';

    public function __construct(UserBaseRepository $userBaseRepository, ActivityRepository $activityRepository)
    {
        $this->userBase = $userBaseRepository;
        $this->activity = $activityRepository;
    }

    /**
     * 微信端志愿者主页
     */
    public function index()
    {
        $this->title = '志愿者主页';
        $this->header = false;
        $isLogin = Auth::check();
        $activityCount = !$isLogin ? 0 : $this->userBase->getActivityCountByUid(Auth::user()->id);
        $userData = $this->userBase->requireById(Auth::user()->id);
        $commentCount = !$isLogin ? 0 : $this->userBase->getCommentCountByUid(Auth::user()->id);
        $totalTime = !$isLogin ? 0 : $this->userBase->getTotalTimeByUid(Auth::user()->id);
        $this->view('mobile.vlt_index',
            compact('commentCount', 'userData', 'activityCount', 'totalTime'));
    }

    /**
     * 评价列表
     */
    public function commentAt()
    {
        $this->title = '评价活动列表';
        $this->header = false;
        $this->view('mobile.comment_at');
    }

    /**
     * 评价页
     */
    public function commentDetail()
    {
        $this->title = '评价活动';
        $this->header = false;
        $this->view('mobile.comment_detail');
    }


    /**
     * 个人信息修改
     */
    public function infoModify()
    {
        $this->title = '个人信息修改';
        $this->header = false;
        $this->view('mobile.vltinfo_modify');
    }

    /**
     * 参加过的不同组织的不同活动
     * hagongyi对于用户的历史页面
     */
    public function atHistory()
    {
        $this->title = '活动历史';
        $this->header = false;
        $this->view('mobile.hgy_atHistory');
    }

    /**
     * 最新活动，哈公益对用户的最新活动页面
     */
    public function atLatest()
    {
        $this->title = '所有最新活动';
        $this->header = false;
        $latestAts = $this->activity->getHgyLatestActivities();
//        dd($latestAts);exit();
        $this->view('mobile.hgy_atLatest', compact('latestAts'));
    }

    /**
     * 组织查询
     */
    public function orgSearch()
    {
        $this->title = '组织查询';
        $this->header = false;
        $this->view('mobile.org_search');
    }
}