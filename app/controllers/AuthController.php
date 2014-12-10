<?php
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 11:08 PM
 */
use Hgy\Account\User;

class AuthController extends BaseController {

    protected $layout = 'layouts.home';

    public function getLogin()
    {
        $this->title = '用户登录';
        $this->view('user.login');
    }

    public function login()
    {
        $userCredential = array(
            'email'  => Input::get('email'),
            'password'  => Input::get('password')
        );
//        if($ret = Auth::validate($userCredential)) {
//            $user = \Hgy\Account\UserBase::where('email', '=', $userCredential['email'])
//                ->first();
//            dd($user->Orgs()->first()->is_verify);exit();
//            Auth::login(User::find(1));
//            return $this->redirectIntended('user/index');
//        }
        if(Auth::attempt($userCredential)) {
            return $this->redirectIntended('user/index');
        }
        else {
            return 'failed';
        }
    }

    public function logout()
    {
        Auth::logout();
        return $this->redirectAction('AuthController@getLogin');
    }
}
