<?php namespace Hgy\Activity;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 3:02 PM
 */

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Hgy\Image\ImageRepository;
use McCool\LaravelAutoPresenter\BasePresenter;

class ActivityPresenter extends BasePresenter {

    /**
     * 未审核，未发布，已发布未进行，正在进
     */
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
        return ($this->isFinished() && $this->resource->status != 3)
                ? '<a href="' . action("AtSummaryController@editSummary", ['activityId'=>$this->resource->id]) . '" id="' . $this->resource->id . '" class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="总结"></a>'
                : '<a href="javascript:void (null);" id="' . $this->resource->id . '" class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="" data-original-title="查看评价"></a>';

    }

    public function status()
    {
        if($this->is_verify == 0)
            return '<label class="label label-default">等待审核</label>';
        if($this->is_verify == 1 && $this->is_published == 0)
            return '<label class="label label-warning">未发布</label>';
        $endTimestamp = intval(strtotime($this->resource->end_time));
        if(time() < $this->resource->start_time)
            $ret = 0;
        elseif (time() < $endTimestamp && time() > $this->resource->start_time)
            $ret = 1;
        else
            $ret = 2;
        if($ret == 2 && $this->resource->status == 1) {
            // 完成状态根据时间计算，字段的status存是否手动设置完成（因为完成需要填写相关的信息，才算完成)
            $ret = 2;
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
        $count = intval(strtotime($this->resource->end_time) - $this->resource->start_time);
        return floor($count % 86300 / 3600 ) . '小时';
//        return $this->countDuration(intval(strtotime($this->resource->end_time)),$this->resource->start_time);
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

    /**
     * 是否开始
     */
    public function isBegin()
    {
        return date('Y-m-d H:i', time()) > $this->resource->start_time;
    }

    /**
     * @return bool是否结束
     */
    public function isFinished()
    {
        return time() > intval(strtotime($this->resource->end_time));
    }

    /**
     * 是否报名
     */
    public function isRegister()
    {
        if(Auth::user()) {
            $currentUid = Auth::user()->id;
        } else {
            $wechatRepo = App::make('\Hgy\Wechat\WechatHelper');
            $openid = $wechatRepo->getOpenId();
            if($openid != null)
                $currentUid = App::make('\Hgy\WechatBind\UserWehatRepository')->getUidByOpenid($openid);
        }

        $isRegister = ActivityAttributeValue::where('uid', '=', $currentUid)
                                            ->where('activity_id', '=', $this->resource->id)
                                            ->first();
        return $isRegister != null;
    }

    public function cover()
    {
        $imageRepo = App::make('\Hgy\Image\ImageRepository');
        return $imageRepo->getImageUrlById($this->resource->cover);
    }

    public function cover_id()
    {
        return $this->resource->cover;
    }

}