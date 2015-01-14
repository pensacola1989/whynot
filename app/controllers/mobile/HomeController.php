<?php namespace mobile;

use Hgy\Account\UserRepository;
use Hgy\Activity\ActivityRepository;
use Hgy\WechatBind\UserWehatRepository;

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

    private $userWechatRepository;

//    protected $layout = 'layouts.mobilelayout';

    public function __construct(UserRepository $userRepository,
                                ActivityRepository $activityRepository,
                                UserWehatRepository $userWehatRepository)
    {
        parent::__construct();
        $this->orgRepository = $userRepository;
        $this->activityRepository = $activityRepository;
        $this->userWechatRepository = $userWehatRepository;
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

    public function joinOrg($orgId)
    {
        $this->title = '绑定用户';
        $this->view('mobile.join_org', compact('orgId'));
    }

    public function postJoinOrg($orgId)
    {
        $openid = 'openisf23sfdsfxx';
        $userName = Input::get('userName');
        $userEmail = Input::get('userEmail');
        $userMobile = Input::get('userMobile');

        $ret = $this->userWechatRepository->bindUserToOrg($openid, $orgId, [
            'userEmail' =>  $userEmail,
            'userMobile'    =>  $userMobile
        ]);
        return ['errorCode'=>0, 'message'=>'绑定成功'];

    }

    public function joinSuccess()
    {
        $this->title = '加入成功';
        $this->view('mobile.join_success');
    }
}