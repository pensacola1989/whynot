<?php
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/30/14
 * Time: 1:34 AM
 */
use Hgy\Activity\ActivityRepository;

class AtSummaryController extends BaseController {

    const AT_STATUS_COMPLETE = 1;

    private $activityRep;

    protected $layout = 'layouts.home';

    public function __construct(ActivityRepository $activityRepository)
    {
        $this->activityRep = $activityRepository;
    }

    public function index()
    {
        $activities = $this->activityRep->getSummaryPaginate($this->getCurrentUser());
        $this->view('activity.summary',compact('activities'));
    }

    /**
     * Http Get
     * @param $activityId
     */
    public function editSummary($activityId=null)
    {
        $this->title = '总结子页面';
        $currentActivity = $this->activityRep->requireById($activityId);
//        dd($currentActivity->start_time);exit();
        $atComplete = $this->activityRep->getSummaryDetail($this->getCurrentUser(),$activityId);
        if(empty($atComplete)) $atComplete = $this->activityRep->getNew([]);
        $this->view('activity.summary_edit',compact('atComplete','activityId','currentActivity'));
    }

    /**
     * Http Post
     * @param $activityId
     * @return mixed
     */
    public function postEditSummary($activityId)
    {
        $inputs = Input::all();
        $newInstance = App::make('Hgy\Activity\ActivitySummaryRepository')->getNew($inputs);
        if(!$newInstance->validate())
            return $this->redirectBack(['errors'    =>  $newInstance->errors()]);
        $ret = $this->activityRep->insertOrUpdateSummaryDetail($this->getCurrentUser(),$activityId, $newInstance);
        if($ret)
            return $this->redirectAction('AtSummaryController@Reply',['activityId'  =>  $activityId]);
    }

    /**
     * Http Get
     * @param $activityId
     */
    public function Reply($activityId)
    {
        $this->title = '志愿者评价';
        $attendWithPivot = $this->activityRep->getAttendeeInfo($this->getCurrentUser(),$activityId);
        $this->view('activity.activity_reply',compact('attendWithPivot','activityId'));
    }

    /**
     * Http Post
     * @param $activityId
     * @return array
     */
    public function postEditVolDuration($activityId)
    {
        $volId = Input::get('volId');

        $data = Input::except('volId');
        if($this->activityRep->updateAttendeeInfo($this->getCurrentUser(),$activityId,$volId,$data)) {
            return ['errorCode' =>  0,  'message'   =>  '更新成功'];
        }
        return ['errorCode' =>  102,    'message'   =>  '操作失败'];
    }

    public function atReplyToVol($activityId)
    {
        $volId = Input::get('volId');
        $data = Input::except('volId');

        if($this->activityRep->summaryReply($this->getCurrentUser(),$activityId,$volId, $data))
            return ['errorCode' =>  0, 'message'    =>  '操作成功'];
        return ['errorCode' =>  102,    'message'   =>  '操作失败'];
    }

    public function postComplete($activityId)
    {
        $ret = $this->activityRep->updateActivityStatus($activityId, self::AT_STATUS_COMPLETE);
        if($ret) return ['errorCode'    =>  0, 'message'    =>  '操作成功'];
        return ['errorCode' =>  102,    'message'   =>  '操作失败'];
    }
}