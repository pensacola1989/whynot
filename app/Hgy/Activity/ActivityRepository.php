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

class ActivityRepository extends EntityRepository
{
    const AT_PER_PAGE_NUM = 7;
    const STATUS_VERIFIED = 2;
    const AT_COMPLETE = 3;

    private $currentUser;

    public function __construct(Activities $model)
    {
        $this->model = $model;
        $this->currentUser = Auth::user();
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
        return $this->_updateAttendeeInfo($activity, $attendId, ['vlt_reply'=>$reply]);
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

    public function getHistoryActivityByUid($uid)
    {
        return ActivityAttributeValue::where('uid', '=', $uid)->get();
    }
}