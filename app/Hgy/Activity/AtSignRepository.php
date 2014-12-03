<?php namespace Hgy\Activity;

use Hgy\Core\EntityRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 12/3/14
 * Time: 1:36 AM
 */

class AtSignRepository extends EntityRepository {

    public function __construct(ActivitySign $model)
    {
        $this->model = $model;
        $this->orgUser = Auth::user();
    }

    public function getSignVolunteers($activityId)
    {
        return $this->orgUser->Activities()->find($activityId)
                            ->ActivitySigns;
    }
}