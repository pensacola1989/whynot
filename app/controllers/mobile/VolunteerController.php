<?php namespace mobile;

use Auth;
use Hgy\Account\UserRepository;
use Input;
use Hgy\Account\UserBaseRepository;
use Hgy\Activity\ActivityRepository;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 12/25/14
 * Time: 12:33 AM
 */

class VolunteerController extends \BaseController {

    private $organization;

    private $userBase;

    private $activity;

//    protected $layout = 'layouts.mobilelayout';
    protected $layout = 'layouts.hgy_layout';

    public function __construct(UserBaseRepository $userBaseRepository,
                                ActivityRepository $activityRepository,
                                UserRepository $userRepository)
    {
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
        $activityCount = !$isLogin ? 0 : $this->userBase->getActivityCountByUid($uid);
        $userData = $this->userBase->requireById($uid);
        $commentCount = !$isLogin ? 0 : $this->userBase->getCommentCountByUid($uid);
        $totalTime = !$isLogin ? 0 : $this->userBase->getTotalTimeByUid($uid);
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
    public function commentDetail($activityId)
    {
        $this->title = '评价活动';
        $this->header = false;
        $currentAt = $this->activity->requireById($activityId);
//        $comment = $this->activity->getUserComment($activityId, $this->getUid())
//                                    ->pivot->vol_reply;
        $cmtModel = $this->activity->getUserComment($activityId, $this->getUid());
        $comment = $cmtModel != null ? $cmtModel->pivot->vol_reply : '';
        $this->view('mobile.comment_detail',
            compact('currentAt', 'comment'));
    }


    public function postComment($activityId)
    {
        if(empty($activityId)) return ['errorCode'=>401,'message'=>'操作失败'];
        $comment = Input::get('comment');
        $rank = Input::get('rank');
        $ret = $this->activity->updateVolunteerReply($activityId, $this->getUid(), $comment);
        if($ret) return ['errorCode'=>0, 'message'=>'操作成功'];
        else    return ['errorCode'=>101, 'message'=>'操作失败'];
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
        $attendAtHistory = $this->userBase->getUserAttendAtHistory(Auth::user()->id);
        $this->view('mobile.hgy_atHistory', compact('attendAtHistory'));
    }

    /**
     * 最新活动，哈公益对用户的最新活动页面
     */
    public function atLatest()
    {
        $this->title = '所有最新活动';
        $this->header = false;
        $latestAts = $this->activity->getHgyLatestActivities();
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

    /**
     * post搜索
     */
    public function postSearch()
    {
        $orgName = Input::get('org_name');
        $type = Input::get('org_type');
        $ret = $this->organization->searchOrgs($orgName, $type);
        return $ret;
    }

    /**
     * 用户修改在哈公益中的信息
     */
    public function postInfoForHgyEdit($uid)
    {
        if($this->getUid() != $uid)
            return ['errorCode'=>401, 'message'=>'没有权限'];
        $user = $this->userBase->requireById($uid);
        if($user == null)
            return ['errorCode'=>404, 'message'=>'未找到用户'];
        if ($ret = $this->userBase->updateUserBaseInfo($uid, Input::all()))
            return ['errorCode'=>0, 'message'=>'修改成功！'];
        else
            return ['errorCode'=>101, 'message'=>'操作失败！'];

    }

    /**
     * 用户评价历史纪录
     */
    public function commentHistory($needComment=false)
    {
        $this->title = '评价列表';
        $this->header = false;
        $uid = $this->getUid();
        $userCommentList = $this->userBase->getUserCommentList($uid, $needComment);
        $this->view('mobile.user_comment_list', compact('userCommentList'));
    }
}