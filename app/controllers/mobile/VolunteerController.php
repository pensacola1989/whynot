<?php namespace mobile;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 12/25/14
 * Time: 12:33 AM
 */

class VolunteerController extends \BaseController {


    protected $layout = 'layouts.mobilelayout';

    /**
     * 微信端志愿者主页
     */
    public function index()
    {
        $this->title = '志愿者主页';
        $this->header = false;
        $this->view('mobile.vlt_index');
    }

    /**
     * 评价列表
     */
    public function commentAt()
    {
        $this->title = '评价活动列表';
        $this->header = false;
        $this->view('mobile.comment_at');
    }

    /**
     * 评价页
     */
    public function commentDetail()
    {
        $this->title = '评价活动';
        $this->header = false;
        $this->view('mobile.comment_detail');
    }
}