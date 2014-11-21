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

class UserController extends BaseController {

    protected $layout = 'layouts.home';

    /**
     * hold user
     * @var userRepo
     */
    private $userRepo;

    /**
     * hold userInfo
     * @var userInfo
     */
    private $userInfo;

    public function __construct(UserRepository $repo,UserInfoRepository $userinfo)
    {
        $this->userRepo = $repo;
        $this->userInfo = $userinfo;
    }
    /*
     * Org user's dashboard
     */
    public function index()
    {
        $this->title = '欢迎来到哈公益';
        $this->view('user.index');
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
            try {
                $this->userRepo->requireById($uid);
            } catch(Exception $e) {
                return $this->redirectAction('UserController@register');
            }
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
            $newUser = $this->userRepo->storeData($input);
            if($newUser)
                return $this->redirectAction('UserController@register',['step'=>2,'uid'=>$newUser->id]);
            else
                return $this->redirectBack(['errors'=>$this->userRepo->getError()]);
        }
        if($step == 2) {
            if($uid == null)
                return $this->redirectAction('UserController@login');
            if($user = $this->userRepo->requireById($uid)) {
                $userinfo = $this->userInfo->getNew(Input::except('step'));
                if(!$userinfo->validate())
                    return $this->redirectBack(['errors'=>$userinfo->errors()]);
                $user->userinfos()->save($userinfo);
                return $this->redirectAction('UserController@register',['step'=>3,'uid'=>$user->id]);
            }
        }
//        if($step == 2 && $uid != null) {
//            if($user = $this->userRepo->requireById($uid)) {
//                if($user) {
//                    $userinfo = $this->userInfo->getNew(Input::except('step'));
//                    if(!$userinfo->validate())
//                        return $this->redirectBack(['errors'=>$userinfo->errors()]);
//                    $user->userinfos()->save($userinfo);
//                    return $this->redirectAction('UserController@register',['step'=>3,'uid'=>$user->id]);
//                }
//            }
//        }
    }

    public function logout()
    {
        Auth::logout();
        return $this->redirectAction('UserController@login');
    }

    private function _isUserVery($uid)
    {
        $user = $this->userRepo->requireById($uid);
        return boolval($user->is_verify );
    }
}
