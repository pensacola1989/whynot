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
        '<label class="label label-warning">正在进行</label>',
        '<label class="label label-success">已结束,未完成</label>',
        '<label class="label label-success">已完成</label>'
    ];

    public function __construct(Activities $activities)
    {
        $this->resource = $activities;
    }

    /**
     * 视图上操作按钮，根据条件生成
     */
    public function controlPannel()
    {
        return $this->resource->status == 0
                ? '<a href="' . action("AtSummaryController@editSummary", ['activityId'=>$this->resource->id]) . '" id="' . $this->resource->id . '" class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="总结"></a>'
                : '<a href="javascript:void (null);" id="' . $this->resource->id . '" class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="" data-original-title="查看评价"></a>';

    }

    public function status()
    {
        $endTimestamp = intval(strtotime($this->resource->end_time));
        if(time() < $this->resource->start_time)
            $ret = 0;
        elseif (time() < $endTimestamp && time() > $this->resource->start_time)
            $ret = 1;
        else
            $ret = 2;
        if($ret == 2 && $this->resource->status == 1) {
            // 完成状态根据时间计算，字段的status存是否手动设置完成（因为完成需要填写相关的信息，才算完成)
            $ret = 3;
        }

        return $this->statusMap[$ret];
    }

    public function isEdit()
    {
        $endTimestamp = intval(strtotime($this->resource->end_time));
        if(time() < $this->resource->start_time)
            $ret = 0;
        elseif (time() < $endTimestamp && time() > $this->resource->start_time)
            $ret = 1;
        else
            $ret = 2;
        if($ret == 2 && $this->resource->status == 1) {
            // 完成状态根据时间计算，字段的status存是否手动设置完成（因为完成需要填写相关的信息，才算完成)
            $ret = 3;
        }
        return $ret >= 2;
    }

    public function start_time()
    {
        $target = is_numeric($this->resource->start_time)
                    ? $this->resource->start_time
                    : strtotime($this->resource->start_time);

//        return date('Y-m-d h:i',$this->resource->start_time);
        return date('Y-m-d h:i',$target);
    }

    public function planDuration()
    {
        return $this->countDuration(intval(strtotime($this->resource->end_time)),$this->resource->start_time);
    }

    private function countDuration($endTime,$startTime)
    {
        $date = floor(($endTime - $startTime) / 86400);
        $hour = floor(($endTime - $startTime) % 86400 / 3600);
//        $minute = floor(($endTime - $startTime) % 86400 / 60);
        $minute = floor($hour % 60);
        $second = floor(($endTime - $startTime) % 86400 % 60);

//        echo $hour;exit();

        return $date . '天' . $hour . '时' . $minute . '分';
    }
}