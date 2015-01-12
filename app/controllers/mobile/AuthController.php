<?php namespace mobile;

use Hgy\Account\UserBase;
use Illuminate\Support\Facades\Hash;
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

    protected $layout = 'layouts.hgy_layout';

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

    /**
     * HTTPGET
     * 修改密码页面
     */
    public function updatePass()
    {
        $this->title = '密码修改';
        $this->header = false;
        $this->view('mobile.mod_pass');
    }


    /**
     * HTTPPOST
     * 修改密码
     */
    public function postUpdatePass()
    {
        $newPass = Input::get('new_pass');
        if(empty($newPass)) return ['errorCode'=>101, 'message'=>'密码不为空'];
        if(!$this->userBase->updateUserPass($this->getUid(), $newPass))
            return ['errorCode'=>101, 'message'=>'操作失败'];
        return ['errorCode'=>0, 'message'=>'操作成功'];
    }

    /**
     * HTTPPOST
     * 检查密码是否正确
     */
    public function checkPass()
    {
        $uid = Auth::user()->id;
        $oldPass = Input::get('old_pass');
        $realOld = $this->userBase->requireById($uid)->password;
        return intval(Hash::check($oldPass, $realOld));
    }

}