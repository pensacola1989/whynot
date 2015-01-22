<?php namespace Hgy\Volunteer;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/22/14
 * Time: 2:57 PM
 */

use Hgy\Core\EntityRepository;
use Auth;

class VolunteerGroupRepository extends EntityRepository {

    private $currentUser;

    public function __construct(VolunteerGroup $group)
    {
        $this->model = $group;
        $this->currentUser = Auth::user();
    }

    /**
     * get the org user's group collection
     * @param $bisId
     */
    public function GetGruopByBisId($bisId)
    {
        return $this->model->where('org_id', '=', $bisId)->get();
    }

    public function getCurrentOrgGroup()
    {
        return $this->currentUser
                    ->Orgs()
                    ->first()
                    ->volunteerGroup;
    }

    public function getGroupNameById($id)
    {
        return $this->model->find($id)->group_name;
    }
}