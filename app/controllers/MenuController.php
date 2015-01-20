<?php
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/19/15
 * Time: 3:49 PM
 */

class MenuController extends BaseController {

    protected $layout = 'layouts.home';

    public function index()
    {
        $this->view('channel.menu');
    }
}