<?php namespace Hgy\Volunteer;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 3:03 PM
 */

use Hgy\Core\EntityRepository;

class VolunteerRepository extends EntityRepository {

    public function __construct(Volunteer $model)
    {
        $this->model = $model;
    }

    public function addGroup($uid,$groupData)
    {

    }

}
