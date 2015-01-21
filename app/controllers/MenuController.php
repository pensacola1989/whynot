<?php

use Hgy\Wechat\MenuRepository;
use Hgy\Wechat\WechatHelper;
use Hgy\Wechat\WeChatClient;
use Hgy\Account\UserRepository;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/19/15
 * Time: 3:49 PM
 */

class MenuController extends BaseController {

    protected $layout = 'layouts.home';

    private $menuRepository;

    private $userRepository;

    public function __construct(MenuRepository $menuRepository, UserRepository $userRepository)
    {
        $this->menuRepository = $menuRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $this->title = '微信自定义菜单';
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
        $orgId = Auth::user()->Orgs()->first()->id;
        $wechatCredentails = $this->userRepository->getOrgWechatCredentail($orgId);
        $wechatClient = new WeChatClient($wechatCredentails->appid, $wechatCredentails->appsecret);
        $menuStr = $this->menuRepository->getMenuByOrgUser();
        return $wechatClient->setMenu($menuStr->menu_str);
    }
}