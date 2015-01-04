<?php namespace mobile;

use Hgy\Activity\ActivityAttribute;
use Hgy\Activity\ActivityAttributeRepository;
use Hgy\Activity\ActivityRepository;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 12/22/14
 * Time: 12:31 AM
 */

class ActivityController extends \BaseController {

    protected $layout = 'layouts.mobilelayout';

    /**
     * Activity 代理
     * @var
     */
    private $activity;
    /**
     * 报名字段代理
     * @var
     */
    private $activityAttribute;

    public function __construct(ActivityRepository $activityRepository,
                                ActivityAttributeRepository $activityAttribute)
    {
        $this->activity = $activityRepository;
        $this->activityAttribute = $activityAttribute;
    }


    /**
     * 最新活动
     */
    public function latest()
    {
        $this->title = '最新活动';
        $this->header = false;
        $this->view('mobile.activity_new');
    }

    /**
     * 活动报名
     */
    public function atRegister($activity_id)
    {
//        $this->title = '湘西助学活动';
        $this->header = false;
        $activity = $this->activity->requireById($activity_id);
        $this->title = $activity->title;
        $attributes = $this->activityAttribute->getAttributeByActivityId($activity_id);
        $this->view('mobile.activity_register',
            compact('activity', 'attributes'));
    }

    /**
     * 活动历史
     */
    public function atHistory()
    {
        $this->title = '活动历史';
        $this->header = false;
        $this->view('mobile.activity_history');
    }

}