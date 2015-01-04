<?php namespace Hgy\Activity;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 3:01 PM
 */

use Hgy\Core\EntityRepository;
use Auth;

class ActivityAttributeRepository extends EntityRepository
{

    private $currentUser;

    public function __construct(ActivityAttribute $model)
    {
        $this->model = $model;
        $this->currentUser = Auth::user();
    }

    public function storeData($data)
    {
        $attr = $this->getNew($data);
        $ret = $this->save($attr);
        if (!$ret) {
            $this->errorMessage = $attr->errors();
        } else {
            return $attr;
        }
    }



    public function UpdateAttributeInfoById($id, $inputArray)
    {
        $oldModel = $this->requireById($id);
        return $oldModel->update($inputArray);
    }

    public function saveAttributes($activityId, $attrObjs)
    {
            $this->currentUser
                ->Orgs()
                ->first()
                ->Activities()
                ->find($activityId)
                ->Attributes()
                ->save($attrObjs);
    }


    private function _getActivitiesAttribute($activityId)
    {
        return $this->currentUser->Orgs()
                                ->first()
                                ->Activities()
                                ->find($activityId)
                                ->Attributes;
    }

    public function updateSortByIdSorts($arr)
    {
        foreach($arr as $a) {
            $res = $this->requireById($a->id);
            $res->sort_number = $a->sort_number;
            $res->save();
        }
    }

    public function getError()
    {
        return $this->errorMessage;
    }

    //------------------- for mobile -------------------

    public function getAttributeByActivityId($activityId)
    {
        return Activities::find($activityId)->Attributes;
    }
}