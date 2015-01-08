<?php namespace Hgy\Activity;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/7/15
 * Time: 6:02 PM
 */

use Hgy\Core\EntityRepository;
use Auth;

class ActivityAttrValue extends EntityRepository {


    public function __construct(ActivityAttributeValue $model)
    {
        $this->model = $model;
    }

    public function storeData($data)
    {
        $attr = $this->getNew($data);
        $ret = $this->save($attr);
        if (!$ret) {
            $this->errorMessage = $attr->errors();
            return null;
        } else {
            return $attr;
        }
    }

    /**
     * 判断用户是否报名
     * @param $uid
     * @param $activityId
     * @return bool
     */
    public function isRegister($uid, $activityId)
    {
        $model = $this->model->where('uid', '=', $uid)
                            ->where('activity_id', '=', $activityId)
                            ->first();
        return $model != null;
    }


    public function getAttrByUidAndAtId($uid, $activityId)
    {
        return $this->model->where('uid', '=', $uid)
                            ->where('activity_id', '=', $activityId)
                            ->first();
    }
}