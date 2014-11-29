<?php namespace Hgy\Volunteer;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/24/14
 * Time: 8:31 PM
 */


class VolunteerSearch {

    protected $model;

    public function __construct(Volunteer $volunteer)
    {
        $this->model = $volunteer;
    }

//    public function searchPaginated($bisUser,$searchFieldArr,$perPageNum)
//    {
//        $query = $bisUser->volunteers();
//        if(count($searchFieldArr)) {
//            foreach ($searchFieldArr as $k => $v) {
//                if($v != '' && $v != '-1') {
//                    $query = $query->where($k, '=', $v);
//                }
//            }
//            return $query->orderBy('updated_at','desc')
//                            ->paginate($perPageNum);
//        }
//        return [];
//    }
    public function searchPaginated($bisUser,$searchFieldArr,$perPageNum)
    {
        $query = $bisUser->CVolunteers();
        if(count($searchFieldArr)) {
            foreach ($searchFieldArr as $k => $v) {
                if($v != '' && $v != '-1') {
                    $query = $query->where($k, '=', $v);
                }
            }
            return $query->orderBy('updated_at','desc')
                            ->paginate($perPageNum);
        }
        return [];
    }
}