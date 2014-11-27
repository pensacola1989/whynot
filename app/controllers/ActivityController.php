<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 11/24/14
 * Time: 8:59 PM
 */

use Hgy\Activity\Activity;
use Hgy\Activity\ActivityPresenter;
use Hgy\Activity\ActivityRepository;

class ActivityController extends BaseController {

    protected $layout = 'layouts.home';

    public function getHome()
    {
        $this->title = '活动情况';
        $this->view('activity.activityHome');
    }

    public function getManage()
    {
        $this->title = '活动管理';
        $this->view('activity.activityManage');
    }

    public function getPublic()
    {
        $this->title = '活动发布';
        $this->view('activity.activityPublic');
    }

    public function getSummary()
    {
        $this->title = '活动总结';
        $this->view('activity.activitySummary');
    }

    public function homeSearch(){
        $currentUser = $this->getCurrentUser();
        $groupOfUser = $currentUser->volunteerGroup;

    }
}
