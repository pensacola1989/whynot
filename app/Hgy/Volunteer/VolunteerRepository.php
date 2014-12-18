<?php namespace Hgy\Volunteer;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 3:03 PM
 */

use Hgy\Core\EntityRepository;
use Hgy\Account\User;
use Auth;

class VolunteerRepository extends EntityRepository {

    const NUMBER_PER_PAGE = 8;

    /**
     * @var当前用户
     */
    private $currentUser;

    public function __construct(Volunteer $model)
    {
        $this->model = $model;
        $this->currentUser = Auth::user();
    }

    /**
     * @param User $bisUser
     * @return mixed
     */
    public function getByBisUser(User $bisUser)
    {
        return $bisUser->CVolunteers()
                        ->paginate(self::NUMBER_PER_PAGE);
//        return $bisUser->volunteers()
//                        ->orderBy('created_at','desc')
//                        ->paginate(self::NUMBER_PER_PAGE);
    }

    public function updateVltStatus(User $bisUser,$id,$status)
    {
        $bisUser->volunteers()->where('id', '=', $id)->update(['is_verify'   =>  $status]);
    }

    public function updateVltStatusWithIds(User $bisUser,$ids,$status)
    {
        $bisUser->Volunteers()->whereIn('id',$ids)->update(['is_verify' => $status]);
    }

    public function updateGroupWithIds (User $bisUser, $ids, $targetGroup)
    {
        $bisUser->Volunteers()->whereIn('id',$ids)->update(['groupd_id' => $targetGroup]);
    }

    public function updateGroup(User $bisUser, $ids, $targetGroup)
    {
        foreach($ids as $id) {
            $bisUser->CVolunteers()->updateExistingPivot($id,['group_id'   =>  $targetGroup]);
        }
    }

    public function getAttributeFieldNames(User $orgUser)
    {
        return $orgUser->VltAttributes->lists('attr_field_name');
    }

    public function getVltDetailById(User $bisUser,$id)
    {
        return $bisUser->volunteers()->where('id', '=', $id)->first()->VolunteerAttrValues;
    }

    public function getCurrentOrgVltCount()
    {
        return $this->currentUser->Orgs()
                                ->first()
                                ->CVolunteers()
                                ->count();
    }

    public function getVltByGroupId($groupid)
    {
//        return $this->_getOrg()
//                    ->volunteerGroup()
//                    ->find($groupid)
//                    ->Volunteers;
        return $this->_getOrg()
                    ->volunteerGroup()
                    ->with('Volunteers')
                    ->find($groupid);
    }

    private function _getOrg()
    {
        return $this->currentUser->Orgs()->first();
    }
}
