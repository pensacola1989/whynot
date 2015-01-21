<?php

use Hgy\Wechat\MenuRepository;
use Hgy\Wechat\WeChatClient;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/19/15
 * Time: 3:49 PM
 */

class MenuController extends BaseController {

    protected $layout = 'layouts.home';

    private $menuRepository;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function index()
    {
        $this->view('channel.menu');
    }

    public function postEditMenu()
    {
        $menuJson = Input::get('menu_json');
        $this->menuRepository->saveMenu($menuJson);
        return ['errorCode'=>0, 'message'=>'保存成功'];
    }

    public function getMenu()
    {
        return $this->menuRepository->getMenuByOrgUser();
    }

    public function generateMenu()
    {

    }
}