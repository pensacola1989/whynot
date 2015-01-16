<?php namespace mobile;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/11/15
 * Time: 9:15 PM
 */
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

class WechatMobileController extends \BaseController {

    /**
     * @var string layout
     */
    protected $layout = 'layouts.mobilelayout';
    /**
     * @var string wechat mobile footer layout
     */
    private $footer = 'layouts.wechat_footer';
    /**
     * @var int organization Id
     */
    protected $orgId;
    /**
     * @var array footer data
     */
    private $footerData = [];

    /**
     * @var 操作openid等表字段
     */
    private $userWechatRepository;

    public function  __construct()
    {
        $this->orgId = $this->_getOrgId();
        $this->footerData['orgId'] = $this->orgId;
        $this->userWechatRepository = App::make('\Hgy\WechatBind\UserWehatRepository');
    }

    protected function view($path, $data = [])
    {
        $this->layout->title = $this->title;
        $this->layout->header = $this->header;
        $this->layout->content = View::make($path, $data);
        $this->layout->footer = View::make($this->footer, $this->footerData);
    }

    private function _getOrgId()
    {
        if(Session::get('current_org_id') != null) {
            return Session::get('current_org_id');
        }
        $routeObj = Route::current()->parameters();
        if($routeObj != null) {
            Session::set('current_org_id', intval($routeObj['orgId']));
            return intval($routeObj['orgId']);
        }
        return  -1;
    }

    public function getUidForHgy()
    {
        $openid = Session::get('openid');
        if($openid != null)
            return $this->userWechatRepository->getUidByOpenid($openid);
        else
            return -1;
    }
}