<?php namespace Hgy\Activity;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 3:01 PM
 */

use Hgy\Core\EntityRepository;

class ActivityAttributeRepository extends EntityRepository
{

//    private $errorMessage;

    public function __construct(ActivityAttribute $model)
    {
        $this->model = $model;
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

    public function getError()
    {
        return $this->errorMessage;
    }
}