<?php namespace Hgy\Activity;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 3:02 PM
 */

use McCool\LaravelAutoPresenter\BasePresenter;

class ActivityPresenter extends BasePresenter {

    private $statusMap = [
        '<label class="label label-default">未开始</label>',
        '<label class="label label-success">正在进行</label>',
        '<label class="label label-warning">已结束</label>'
    ];

    public function __construct(Activities $activities)
    {
        $this->resource = $activities;
    }

    public function status()
    {
        return $this->statusMap[$this->resource->status];
    }

    public function planDuration()
    {
        return $this->countDuration(intval(strtotime($this->resource->end_time)),$this->resource->start_time);
    }

    private function countDuration($endTime,$startTime)
    {
        $date = intval(($endTime - $startTime)/86400);
        $hour = intval(($endTime - $startTime)%86400/3600);
        $minute = intval(($endTime - $startTime)%86400/60);
        $second = intval(($endTime - $startTime)%86400%60);

        return $date . '天' . $hour . '时' . $minute . '分';
    }
}