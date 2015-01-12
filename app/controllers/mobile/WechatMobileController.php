<?php namespace mobile;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/11/15
 * Time: 9:15 PM
 */
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

    public function  __construct()
    {
        $this->orgId = $this->_getOrgId();
        $this->footerData['orgId'] = $this->orgId;
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
        $routeObj = Route::current()->parameters();
        return $routeObj != null ? intval($routeObj['orgId']) : -1;
    }
}