<?php namespace Hgy\Volunteer;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/22/14
 * Time: 2:57 PM
 */

use Hgy\Core\EntityRepository;

class VolunteerGroupRepository extends EntityRepository {

    public function __construct(VolunteerGroup $group)
    {
        $this->model = $group;
    }

    /**
     * get the org user's group collection
     * @param $bisId
     */
    public function GetGruopByBisId($bisId)
    {
        return $this->model->where('org_id', '=', $bisId)->get();
    }

}