<?php namespace mobile;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 12/20/14
 * Time: 1:31 AM
 */

class HomeController extends \BaseController {

    protected $layout = 'layouts.mobilelayout';

    public function index()
    {
        $this->title = '首页';
        $this->view('mobile.home');
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
}