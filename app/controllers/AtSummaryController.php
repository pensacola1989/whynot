<?php
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/30/14
 * Time: 1:34 AM
 */
use Hgy\Activity\ActivityRepository;

class AtSummaryController extends BaseController {

    private $activityRep;

    protected $layout = 'layouts.home';

    public function __construct(ActivityRepository $activityRepository)
    {
        $this->activityRep = $activityRepository;
    }

    public function index()
    {
        $activities = $this->activityRep->getSummaryPaginate($this->getCurrentUser());
        $this->view('activity.summary',compact('activities'));
    }
}