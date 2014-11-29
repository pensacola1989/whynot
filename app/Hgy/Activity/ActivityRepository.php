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
}