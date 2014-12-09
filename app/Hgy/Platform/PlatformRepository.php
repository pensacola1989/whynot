<?php namespace Hgy\Platform;

use Hgy\Account\UserBase;
use Hgy\Activity\Activities;
use Hgy\Core\EntityRepository;
use Hgy\Account\User;
use Illuminate\Support\Facades\Paginator;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 12/8/14
 * Time: 10:48 PM
 */

class PlatformRepository extends EntityRepository {

    const PER_PAGE_NUM = 5;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAllOrgsPaginate($isVerify=null)
    {
        if($isVerify == null) {
            return User::with(['Admins', 'userinfos'])->paginate(self::PER_PAGE_NUM);
        }
        return User::with(['Admins', 'userinfos'])->where('is_verify', '=', $isVerify)->paginate(self::PER_PAGE_NUM);
    }

    /**
     * 审核或者否决（禁用）
     * @param $id
     * @param $status
     * @return bool|int
     */
    public function updateOrgStatusBatch($ids, $status)
    {
        foreach($ids as $id) {
            $this->model->find($id)->update(['is_verify' => $status]);
        }
    }

}