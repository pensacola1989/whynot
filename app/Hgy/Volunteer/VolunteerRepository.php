<?php namespace Hgy\Volunteer;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 3:03 PM
 */

use Hgy\Core\EntityRepository;
use Hgy\Account\User;

class VolunteerRepository extends EntityRepository {

    const NUMBER_PER_PAGE = 5;

    public function __construct(Volunteer $model)
    {
        $this->model = $model;
    }

    /**
     * @param User $bisUser
     * @return mixed
     */
    public function getByBisUser(User $bisUser)
    {
        return $bisUser->volunteers()
                        ->orderBy('created_at','desc')
                        ->paginate(self::NUMBER_PER_PAGE);
    }
}
