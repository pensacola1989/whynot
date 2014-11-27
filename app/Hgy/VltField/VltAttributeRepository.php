<?php namespace Hgy\VltField;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/26/14
 * Time: 1:49 AM
 */
use Hgy\Core\EntityRepository;
use Hgy\Account\User;
use Hgy\Volunteer\Volunteer;
use Illuminate\Support\Facades\DB;

class VltAttributeRepository extends EntityRepository {

    public function __construct(VltAttribute $model)
    {
        $this->model = $model;
    }

    public function getAttributeInfoByOrg(User $user)
    {
        return $user->VltAttributes;
    }

    public function UpdateAttributeInfoById($id,$inputArray)
    {
        $oldModel = $this->requireById($id);
        return $oldModel->update($inputArray);
    }

    public function getAttributeInfoByOrgAndOrder(User $user)
    {
        return $user->VltAttributes()->orderBy('sort_number','asc')->get();
    }

    public function updateSortByIdSorts(User $user,$arr)
    {
//        $res = $this->requireById(14);
        $res = VltAttribute::find(14);

        $res->sort_number = 3;
        $res->save();
//        foreach($arr as $a) {
//            $res = $this->requireById($a->id);
//            $res->sort_number = intval($a->sort_number);
//            $res->save();
////            var_dump(DB::getQueryLog());
//        }
    }
}