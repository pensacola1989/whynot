<?php namespace Hgy\Activity;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 3:01 PM
 */

use Hgy\Account\User;
use Hgy\Core\EntityRepository;

class ActivityRepository extends EntityRepository
{
    const AT_PER_PAGE_NUM = 7;

    public function __construct(Activities $model)
    {
        $this->model = $model;
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

    public function getError()
    {
        return $this->errorMessage;
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
        return $activity->Attendees;
    }

    public function updateAttendeeInfo(User $user,$activityId,$attendeeId,$info)
    {
        $activity = $user->Activities()->where('id', '=', $activityId)->first();
        return $activity->Attendees()->updateExistingPivot($attendeeId,$info);
    }

    public function getSummaryReply(User $user, $activityId)
    {

    }
}