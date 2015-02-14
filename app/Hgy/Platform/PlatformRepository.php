<?php namespace Hgy\Platform;

use Hgy\Account\UserBase;
use Hgy\Activity\Activities;
use Hgy\Core\EntityRepository;
use Hgy\Account\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Paginator;
use LaravelBook\Ardent\Ardent;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 12/8/14
 * Time: 10:48 PM
 */

class PlatformRepository extends EntityRepository {

    const PER_PAGE_NUM = 5;

    private $activities;

    public function __construct(User $model, Activities $activities)
    {
        $this->model = $model;
        $this->activities = $activities;
    }

    /**
     * 获取分业的所有公益组织信息
     * @param null $isVerify
     * @return \Illuminate\Pagination\Paginator
     */
    public function getAllOrgsPaginate($isVerify=null)
    {
        if($isVerify == null) {
            return User::with(['Admins', 'userinfos'])->paginate(self::PER_PAGE_NUM);
        }
        return User::with(['Admins', 'userinfos'])->where('is_verify', '=', $isVerify)->paginate(self::PER_PAGE_NUM);
    }

    public function getAllActivitiesPaginate($isVerify=null)
    {
        if($isVerify == null) {
            return Activities::orderBy('updated_at', 'desc')->paginate(self::PER_PAGE_NUM);
        }
        return Activities::where('is_verify', '=', $isVerify)->orderBy('updated_at', 'desc')->paginate(self::PER_PAGE_NUM);
    }

    /**
     * 审核或者否决（禁用）
     * @param $ids
     * @param $status
     * @internal param $id
     * @return bool|int
     */
    public function updateOrgStatusBatch($ids, $status)
    {
        foreach($ids as $id) {
            $this->model->find($id)->update(['is_verify' => $status]);
        }
    }

    /**
     * @param $ids
     * @param $status
     */
    public function updateActivityStatusBatch($ids, $status)
    {
        $this->_updateObjectBatch($this->activities, $ids, $status);
    }

    private function _updateObjectBatch($obj, $ids, $arr)
    {
        if($obj instanceof Ardent) {
            foreach($ids as $id) {
                $obj->find($id)->update($arr);
            }
        }
    }

    /**
     * 组织总数
     */
    public function getOrgCount()
    {
        return $this->model->count();
    }

    /**
     * 审核总数
     */
    public function getVerifyOrgCount()
    {
        return $this->model->where('is_verify', '=', 1)->count();
    }

}