<?php
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/17/14
 * Time: 8:59 PM
 */
class UserController extends BaseController {

    protected $layout = 'layouts.home';

    /*
     * Org user's dashboard
     */
    public function index()
    {
        $this->title = '欢迎来到哈公益';
        $this->view('user.index');
    }

    /*
     * Org user's register page
     */
    public function register()
    {
        $this->title = '组织用户注册';
        $this->view('user.register');
    }

    /*
     * HTTPPOST
     * add a user
     */
    public function add()
    {

    }
}