<?php namespace mobile;

use Hgy\Account\UserRepository;
use Hgy\Activity\ActivityRepository;
use Input;
use Illuminate\Support\Facades\Route;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 12/20/14
 * Time: 1:31 AM
 */

class HomeController extends WechatMobileController {

    private $orgRepository;

    private $activityRepository;

//    protected $layout = 'layouts.mobilelayout';

    public function __construct(UserRepository $userRepository,
                                ActivityRepository $activityRepository)
    {
        parent::__construct();
//        dd(Route::current()->parameters());exit();
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
        $this->title = '绑定用户';
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