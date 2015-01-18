<?php namespace mobile;

use Hgy\Account\UserBase;
use Hgy\Account\UserRepository;
use Hgy\Activity\ActivityRepository;
use Hgy\VltField\VltAttributeRepository;
use Hgy\WechatBind\UserWehatRepository;
use Auth;
use Input;
use App;
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

    private $vltAttributeRepository;

//    protected $layout = 'layouts.mobilelayout';

    public function __construct(UserRepository $userRepository,
                                ActivityRepository $activityRepository,
                                UserWehatRepository $userWehatRepository,
                                VltAttributeRepository $vltAttributeRepository)
    {
        parent::__construct();
        $this->orgRepository = $userRepository;
        $this->activityRepository = $activityRepository;
        $this->userWechatRepository = $userWehatRepository;
        $this->vltAttributeRepository = $vltAttributeRepository;
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
        // 获取组织需要用户填写的自定义信息
        $orgModel = $this->orgRepository->requireById($orgId);
        $vltAttributes = $orgModel ? $orgModel->VltAttributes : null;
        $this->view('mobile.join_org', compact('orgId', 'vltAttributes'));
    }

    public function postJoinOrg($orgId)
    {
//        $openid = 'open123123xxx-';
        $wechatHelper = App::make('\Hgy\Wechat\WechatHelper');
        $openid = $wechatHelper->getOpenId();
        $userName = Input::get('userName');
        $userEmail = Input::get('userEmail');
        $userMobile = Input::get('userMobile');

        $userValues = Input::get('values');

        $ret = $this->userWechatRepository->bindUserToOrg($openid, $orgId, [
            'userEmail' =>  $userEmail,
            'userMobile'    =>  $userMobile,
            'userName'  =>  $userName
        ]);
        // 开始绑定组织需要用户填写的自定义信息
        $this->userWechatRepository->saveUserCustomizeInfo($orgId, $ret->id, $userValues);

        return ['errorCode'=>0, 'message'=>'绑定成功'];

    }


    /** 修改用户对组织对自定义信息
     * @param $orgId
     * @return array
     */
    public function postModifyVolInfo($orgId)
    {
        $wechatHelper = App::make('\Hgy\Wechat\WechatHelper');
        $openid = $wechatHelper->getOpenId();
        $userValues = Input::get('values');
        $uid = $this->userWechatRepository->getUidByOpenid($openid);
//        $uid = 32;
        $this->userWechatRepository->updateUserCustomizeInfo($orgId, $uid, ['value'=>$userValues]);

        return ['errorCode'=>0, 'message'=>'更新成功'];
    }

    /**
     * 修改用户对某个组织对个人信息
     */
    public function modifyVolInfo($orgId)
    {
        $this->title = '修改自定义信息';
        $uid = $this->getUid();
        $orgModel = $this->orgRepository->requireById($orgId);
        $vltAttributes = $orgModel ? $orgModel->VltAttributes : null;
        $jsonVltValues = $this->orgRepository->getVolValueByOrgIdAndUid($orgId, $uid);
//        $vltValue = json_decode($jsonVltValues->pivot->value, true);
        $vltValue = $jsonVltValues;
        $this->view('mobile.vltinfo_org', compact('orgId', 'vltValue', 'vltAttributes'));
    }


    public function joinSuccess()
    {
        $this->title = '加入成功';
        $this->view('mobile.join_success');
    }
}