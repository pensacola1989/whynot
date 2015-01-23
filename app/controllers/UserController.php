<?php
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/17/14
 * Time: 8:59 PM
 */

use Hgy\Account\User;
use Hgy\Account\UserRepository;
use Hgy\Account\UserInfoRepository;
use Hgy\Activity\ActivityRepository;
use Hgy\Account\UserBaseRepository;
use Hgy\Volunteer\VolunteerRepository;
use Hgy\Volunteer\VolunteerGroupRepository;

class UserController extends BaseController {

    protected $layout = 'layouts.home';

    /**
     * hold user
     * @var userRepo
     */
    private $userRepo;
    /**
     * 用户基础信息管理
     * @var \Hgy\Account\UserBaseRepository
     */
    private $userBase;
    /**
     * hold userInfo
     * @var userInfo
     */
    private $userInfo;
    /**
     * @var Activity管理
     */
    private $activityRepo;
    /**
     * @var 志愿者管理
     */
    private $vltRepo;
    /**
     * @var 志愿者组管理
     */
    private $vltGroupRepo;
    public function __construct(UserRepository $repo,
                                UserInfoRepository $userinfo,
                                UserBaseRepository $userBaseRepository,
                                ActivityRepository $activityRepository,
                                VolunteerRepository $volunteerRepository,
                                VolunteerGroupRepository $groupRepository)
    {
        $this->userRepo = $repo;
        $this->userInfo = $userinfo;
        $this->userBase = $userBaseRepository;
        $this->activityRepo = $activityRepository;
        $this->vltGroupRepo = $groupRepository;
        $this->vltRepo = $volunteerRepository;
    }
    /*
     * Org user's dashboard
     */
    public function index()
    {
        $this->title = '欢迎来到哈公益';
        $currentActivity = $this->activityRepo->getLastestActivity();
        $needSummary = $this->activityRepo->getCompleteAndUnSummaryActivity();
        $vltCount = $this->vltRepo->getCurrentOrgVltCount();
        $orgGroups = $this->vltGroupRepo->getCurrentOrgGroup();
        $this->view('user.index',compact('currentActivity', 'needSummary', 'vltCount', 'orgGroups'));
    }

    /**
     * Org user's register page
     * @param null $uid
     * @param null $step
     */
    public function register($step=null,$uid=null)
    {
        if(Auth::check()) return $this->redirectAction('UserController@index');
        $step = !empty($step) ? $step : 1;
        if($step == 1) {
            $this->title = '组织用户注册';
            $this->view('user.register',['step' => $step]);
        } elseif($step == 2 && $uid != null) {
            $userBase = $this->userBase->requireById($uid);
            if(!$userBase)
                return $this->redirectAction('UserController@register');
            if($userBase->Orgs()->first())
                return $this->redirectAction('UserController@register',['step'=>3, 'uid'=>$uid]);
//            try {
//                $this->userRepo->requireById($uid);
//            } catch(Exception $e) {
//                return $this->redirectAction('UserController@register');
//            }
            $this->title = '组织用户注册';
            $this->view('user.register',['step' => $step,'uid' => $uid]);
        } elseif($step == 3 && $uid != null) {
            $isVerify = $this->_isUserVery($uid);
            $this->view('user.register',['step' => $step, 'is_verify' => $isVerify]);
        }
        else {
            $this->view('user.register',['step' => 1]);
        }

    }

    /**
     *
     * add a user
     * @param null $uid
     * @throws \Hgy\Core\Exceptions\EntityNotFoundException
     * @return void
     */
    public function add($step=null,$uid=null)
    {
        $step = Input::get('step');
        $step = !empty($step) ? $step : 1;
        if($step == 1) {
            $input = Input::except('step');
            $input = Input::except('agree');
            $newUser = $this->userBase->storeData($input);
            if($newUser)
                return $this->redirectAction('UserController@register',['step' =>2,'uid' => $newUser->id]);
            else
                return $this->redirectBack(['errors'=>$this->userBase->getError()]);
        }
        if($step == 2) { // 这里的uid指的是UserBase的id
            if($uid == null)
                return $this->redirectAction('UserController@login');
            if($user = $this->userBase->getById($uid)) {
                $userinfo = $this->userInfo->getNew(Input::except('step'));
                if(!$userinfo->validate())
                    return $this->redirectBack(['errors'=>$userinfo->errors()]);
                $tempOrgData = [
                    'is_verify' =>  0
                ];
                $ret = $this->userRepo->storeData($tempOrgData);
                $org = $this->userRepo->requireById($ret->id);
                $org->userinfos()->save($userinfo);
                $user->Orgs()->attach($ret->id);
                return $this->redirectAction('UserController@register',['step'=>3,'uid'=>$uid]);
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        return $this->redirectAction('UserController@login');
    }

    private function _isUserVery($uid)
    {
        return boolval($this->userBase->requireById($uid)->Orgs()->first()->is_verify);
    }
}
