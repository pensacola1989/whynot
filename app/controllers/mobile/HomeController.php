<?php namespace mobile;

use Hgy\Account\UserRepository;
use Hgy\Activity\ActivityRepository;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 12/20/14
 * Time: 1:31 AM
 */

class HomeController extends \BaseController {

    private $orgRepository;

    private $activityRepository;

    protected $layout = 'layouts.mobilelayout';

    public function __construct(UserRepository $userRepository,
                                ActivityRepository $activityRepository)
    {
        $this->orgRepository = $userRepository;
        $this->activityRepository = $activityRepository;
    }

    public function index($orgId)
    {
        $this->header = false;
        $currentOrg = $this->orgRepository->getUserInfoByUid($orgId);
        $vltCount = $this->orgRepository->getTotalVolunteers($orgId);
        $activityCount = $this->orgRepository->getTotalCompleteActivities($orgId);
        $latestActivities = $this->activityRepository->getLatestActivityByOrgId($orgId);

        $this->title = '首页';
        $this->view('mobile.home', compact('currentOrg', 'vltCount', 'activityCount', 'latestActivities'));
    }

    public function joinOrg()
    {
        $this->title = '加入组织';
        $this->view('mobile.join_org');
    }

    public function joinSuccess()
    {
        $this->title = '加入成功';
        $this->view('mobile.join_success');
    }
    public function fuck()
    {
    }
}