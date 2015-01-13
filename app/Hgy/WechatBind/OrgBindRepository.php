<?php namespace Hgy\WechatBind;

use Hgy\Core\EntityRepository;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/14/15
 * Time: 12:52 AM
 */

class OrgBindRepository extends EntityRepository {

    public function __construct(OrgWechatBind $model)
    {
        $this->model = $model;
    }

}