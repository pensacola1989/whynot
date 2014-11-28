<?php namespace Hgy\Volunteer;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 3:03 PM
 */
use App,Auth;
use McCool\LaravelAutoPresenter\BasePresenter;

class VolunteerPresenter extends BasePresenter {

    const UN_GROUP_NAME = '未分组';

    private $verifyMap = [
        '<em style="color:orange;">未审核</em>',
        '<em style="color:green">已审核</em>',
        '<em style="color:#ddd;">正在审核</em>',
        '<em style="color:#ddd;">已锁定</em>'
    ];


    public function __construct(Volunteer $volunteer)
    {
        $this->resource = $volunteer;
    }

    public function is_verify()
    {
        if($this->resource->is_verify == -1) return '<em style="color:red;">已拒绝</em>';
        return $this->verifyMap[$this->resource->is_verify];
    }

    public function groupd_id()
    {
        $user = $this->resource->Organizations()
                                ->where('org_id', '=', Auth::user()->id)
                                ->first();
        if($user->pivot->group_id == 0) return self::UN_GROUP_NAME;
        
        return $user->volunteerGroup()
                    ->where('id', '=', $user->pivot->group_id)
                    ->pluck('group_name');

//        $groupId = $this->resource
//                    ->Organizations
//                    ->pivot
//                    ->group_id;
//
//        return $user->CVolunteers->pivot->group_id;
//        $repo = App::make('Hgy\Account\UserRepository');
//        $user = $repo->requireById(Auth::user()->id);

//        $ret = $user->volunteerGroup()
//                    ->where('id', '=', $this->resource->groupd_id)
//                    ->pluck('group_name');
//        return $ret;
    }

    public function orgGroup()
    {
        $user = $this->resource->belongUser;
        return $user->with(['volunteerGroup' => function($query) {
                    $query->select('group_name');
                }])->get();
    }

    public function isLock()
    {
        return $this->resource->is_verify == 3;
    }
}