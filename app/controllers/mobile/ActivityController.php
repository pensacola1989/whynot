<?php namespace mobile;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 12/22/14
 * Time: 12:31 AM
 */

class ActivityController extends \BaseController {

    protected $layout = 'layouts.mobilelayout';

    /**
     * 最新活动
     */
    public function latest()
    {
        $this->title = '最新活动';
        $this->header = false;
        $this->view('mobile.activity_new');
    }

    /**
     * 活动报名
     */
    public function atRegister()
    {
        $this->title = '湘西助学活动';
        $this->header = false;
        $this->view('mobile.activity_register');
    }

    /**
     * 活动历史
     */
    public function atHistory()
    {
        $this->title = '活动历史';
        $this->header = false;
        $this->view('mobile.activity_history');
    }
}