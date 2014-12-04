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

    public function saveAttributes($activityId, $attrObjs)
    {
        foreach($attrObjs as $obj) {
            $newObj = $this->getNew($obj);

            $this->currentUser
                ->Activities()
                ->find($activityId)
                ->Attributes()
                ->save($newObj);
        }
    }

    public function getError()
    {
        return $this->errorMessage;
    }
}