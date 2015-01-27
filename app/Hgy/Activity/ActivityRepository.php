<?php namespace Hgy\Activity;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 3:01 PM
 */

use Hgy\Account\User;
use Hgy\Account\UserBase;
use Hgy\Core\EntityRepository;
use Auth;
use App;
use Illuminate\Support\Facades\DB;

class ActivityRepository extends EntityRepository
{
    const AT_PER_PAGE_NUM = 7;
    const STATUS_VERIFIED = 2;
    const AT_COMPLETE = 3;

    private $currentUser;
    private $currentOrg;

    public function __construct(Activities $model)
    {
        $this->model = $model;
        $this->currentUser = Auth::user();
        $this->currentOrg = Auth::user()->Orgs()->first();
    }

    /**
     * store data
     * @param $data
     * @return mixed
     */
    public function storeData($data)
    {
        $activity = $this->getNew($data);
        $ret = $this->save($activity);
        if (!$ret) {
            $this->errorMessage = $activity->errors();
        } else {
            return $activity;
        }
    }


    public function getActivities(User $user)
    {
        return $user->Activities()->paginate(self::AT_PER_PAGE_NUM);
    }

    public function getError()
    {
        return $this->errorMessage;
    }

    public function getAttrByOrderNum($activityId)
    {
        return $this->model
                    ->find($activityId)
                    ->Attributes()
                    ->orderBy('sort_number', 'asc')
                    ->get();
    }

    public function getSummaryPaginate(User $orgUser)
    {
        return $orgUser->Activities()
                        ->orderBy('created_at','desc')
                        ->paginate(self::AT_PER_PAGE_NUM);
    }

    public function getSummaryDetail(User $orgUser,$activityId)
    {
        return $orgUser->Activities()
                        ->where('id', '=', $activityId)
                        ->first()
                        ->ActivityComplete;
    }

    public function insertOrUpdateSummaryDetail(User $orgUser,$activityId,$detail)
    {
        $complete = $orgUser->Activities()->find($activityId)->ActivityComplete;
        if(!$complete) {
            return $orgUser->Activities()
                            ->find($activityId)
                            ->ActivityComplete()
                            ->save($detail);
        } else {
            return $orgUser->Activities()
                            ->find($activityId)
                            ->ActivityComplete
                            ->update($detail->toArray());
        }
    }

    public function getAttendeeInfo(User $user,$activityId)
    {
        $activity = $user->Activities()->where('id', '=', $activityId)->first();
        return $activity->Attendees()->paginate(self::AT_PER_PAGE_NUM);
    }

    public function updateAttendeeInfo(User $user,$activityId,$attendeeId,$info)
    {
        $activity = $user->Activities()->where('id', '=', $activityId)->first();
        return $activity->Attendees()->updateExistingPivot($attendeeId,$info);
    }

    public function summaryReply(User $user, $activityId, $attendeeId, $info)
    {
        $activity = $this->_getActivity($user,$activityId);
        return $this->_updateAttendeeInfo($activity, $attendeeId, $info);
    }

    public function updateVolunteerReply($activityId, $attendId, $reply)
    {
        $activity = $this->model->find($activityId);
        return $this->_updateAttendeeInfo($activity, $attendId, ['vol_reply'=>$reply]);
    }

    public function saveNewActivity(User $user, $inputs)
    {
        $obj = $this->getNew($inputs);
        $ret = $user->Activities()->save($obj);
        if(!$ret) $this->errorMessage = $obj->errors();
        else return $obj;
    }

    private function _getActivity(User $user, $activityId)
    {
        return $user->Activities()->where('id', '=', $activityId)->first();
    }

    private function _updateAttendeeInfo(Activities $activity, $attendeeId, $info)
    {
        return $activity->Attendees()->updateExistingPivot($attendeeId, $info);
    }

    public function ApproveWithIds(User $user, $activityId, $vltIds)
    {
        $this->_updateApproveStatusWithBatch($user, $activityId, $vltIds, 1);
    }

    public function RejectWithIds(User $user, $activityId, $vltIds)
    {
        $this->_updateApproveStatusWithBatch($user, $activityId, $vltIds, 0);
    }

    public function updateActivityStatus($activityId, $statusCode)
    {
        return $this->currentUser->Activities()->find($activityId)->update(['status' =>  $statusCode]);
    }

    private function _updateApproveStatusWithBatch(User $user, $activityId, $vltIds, $type)
    {
        foreach ($vltIds as $id) {
            $user->Activities()
                ->find($activityId)
                ->Attendees()
                ->updateExistingPivot($id, ['is_verify' => intval($type)]);
        }
    }

    public function publishAt($activityId)
    {
        return $this->model->find($activityId)
                            ->update(['is_verify'  =>  2]);
    }

    /**
     * @return mixed当前最新正在进行的活动
     */
    public function getLastestActivity()
    {
        return $this->currentUser->Orgs()
                    ->first()
                    ->Activities()
                    ->where('is_verify', '=', self::STATUS_VERIFIED)
                    ->where('start_time', '<', date('Y-m-d H:i:s',time()))
                    ->where('end_time', '>', date('Y-m-d H:i:s',time()))
                    ->first();
    }

    public function getCompleteAndUnSummaryActivity()
    {
        return $this->currentUser->Orgs()
                    ->first()
                    ->Activities()
                    ->where('is_verify', '=', self::STATUS_VERIFIED)
                    ->where('end_time', '<', date('Y-m-d H:i:s',time()))
                    ->first();
    }

    // -----------------哈公益微信端--------------------
    /**
     * 获取未开始的活动
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getHgyLatestActivities()
    {
        return User::with(['Activities' =>  function($query) {
            $query->where('start_time', '>', date('Y-m-d H:i', time()));
        }])->with('userinfos')->get();
    }

    /**
     * 获取某个组织的最新活动
     * @param $orgId
     */
    public function getLatestActivityByOrgId($orgId)
    {
        return $this->model->where('start_time', '>', date('Y-m-d H:i', time()))
                            ->where('bizid', '=', $orgId)
                            ->get();
    }

    /** 获取某个用户参加的活动历史
     * @param $uid
     * @return mixed
     */
    public function getHistoryActivityByUid($uid)
    {
        return ActivityAttributeValue::where('uid', '=', $uid)->get();
    }

    /** 获取某个组织对活动纪录(已完成)
     * @param $orgId
     */
    public function getHistoryActivityByOrgId($orgId)
    {
        return $this->model->where('bizid', '=', $orgId)
                            ->where('end_time', '<', date('Y-m-d H:i', time()))
                            ->get();
    }

    /** 获取某个用户对某个活动对评价
     * @param $activityId
     * @param $uid
     * @return mixed
     */
    public function getUserComment($activityId, $uid)
    {
        return $this->model->find($activityId)
                            ->Attendees()
                            ->where('uid', '=', $uid)
                            ->first();
    }


    // -----------------公众号微信端--------------------
    public function getOrgIdByActivityId($activityId)
    {
        $activity = $this->model->find($activityId);
        if($activityId != null)
            return $activity->BelongOrg->id;
    }

    public function getUserNeedSignByOrgId($orgId, $uid)
    {
        return  User::find($orgId)
                    ->Activities()
                    ->where('start_time', '>', date('Y-m-d H:i', time()))
                    ->whereHas('ActivitySigns', function ($q) use ($uid) {
                        $q->where('sign_vlt_id', '<>', $uid);
                    })->get();
    }

    /** 用户输入的签到码是否正确
     * @param $inputCode
     * @param $activityId
     * @return bool
     */
    public function isSignCodeMatch($inputCode, $activityId)
    {
        $trueCode = $this->model->find($activityId)->sign_code;
        return $inputCode == $trueCode;
    }

    /** 是否已经签到
     * @param $uid
     * @param $activityId
     * @return bool
     */
    public function isSigned($uid, $activityId)
    {
        $count = $this->model->find($activityId)
                            ->ActivitySigns()
                            ->where('sign_vlt_id', '=', $uid)
                            ->count();
        return $count > 0;
    }

    /** 对一个活动签到
     * @param $uid
     * @param $activityId
     */
    public function signActivity($uid, $activityId)
    {
        $repo = App::make('\Hgy\Activity\AtSignRepository');
        $newModel = $repo->getNew([
            'sign_vlt_id' => $uid,
            'sign_activity_id'  =>  $activityId
        ]);

        $this->model->find($activityId)
                            ->ActivitySigns()
                            ->attach($uid);
    }

    public function isActicityVerified($activityId)
    {
        $activity = $this->currentOrg
                            ->Activities()
                            ->where('id', '=', $activityId)
                            ->first();
        return $activity->is_verify != 0;



    }
}