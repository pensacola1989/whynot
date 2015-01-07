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
}