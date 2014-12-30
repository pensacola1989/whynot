<?php namespace mobile;

use Hgy\Account\UserBase;
use Input;
use Auth;
use Hgy\Account\UserBaseRepository;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 12/29/14
 * Time: 10:02 PM
 */

class AuthController extends \BaseController {

    /**
     * @var userBase 代理
     */
    private $userBase;

    protected $layout = 'layouts.mobilelayout';

    public function __construct(UserBaseRepository $userBaseRepository)
    {
        $this->userBase = $userBaseRepository;
    }
    /**
     * 哈公益登录页面GET
     */
    public function loginToHgy()
    {
        $this->title = '登录哈公益';
        $this->header = false;
        $this->view('mobile.hgy_login');
    }

    /**
     * 哈公益注册页面
     */
    public function register()
    {
        $this->title = '注册哈公益';
        $this->header = false;
        $this->view('mobile.hgy_register');
    }

    /**
     * 验证登录请求 POST
     */
    public function checkLogin()
    {
        $loginCredential = Input::get('emailOrMobile');
        $loginPass = Input::get('password');
        $ret = false;
        $type = '';

        if($this->userBase->isEmail($loginCredential)) {
            $ret = Auth::validate([
                'email' =>  $loginCredential,
                'password'  =>  $loginPass
            ]);
            $type = 'email';
        } elseif($this->userBase->isMobile($loginCredential)) {
            $ret = Auth::validate([
                'mobile' =>  $loginCredential,
                'password'  =>  $loginPass
            ]);
            $type = 'mobile';
        }

        if($ret) {
            $user = \Hgy\Account\UserBase::where($type, '=', $loginCredential)->first();
            Auth::login(UserBase::find($user->id));
            return ['errorCode' =>  0];
//            return $this->redirectIntended('mobile/vlt/index');
        }
        else {
            return ['errorCode' =>  100]; // login failed
        }
    }

    /**
     * 注册post请求
     */
    public function postRegister()
    {
        $input = Input::all();
        $newUser = $this->userBase->storeData($input);
        if($newUser)
            return $this->redirectAction('mobile\VolunteerController@index');
        else
            return $this->redirectBack(['errors'=>$this->userBase->getError()]);
    }

}