<?php
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/16/15
 * Time: 1:06 AM
 */
use Hgy\Wechat\ChannelRepository;
use Illuminate\Support\Facades\Session;

class ChannelController extends BaseController {

    /** Channel
     * @var
     */
    private $channel;

    protected $layout = 'layouts.home';

    public function __construct(ChannelRepository $channelRepository)
    {
        $this->channel = $channelRepository;
    }

    public function index()
    {
        $this->title = '渠道设置';
        if(Session::get('success') == 1) {
            echo '<script type="text/javascript">alert("更新成功！");</script>';
        }
        $interfaceInfos = $this->channel->generateWechatUrlAndToken();
        $WechatChannel = $this->channel->getOrgChannel();
        $this->view('channel.index', compact('WechatChannel', 'interfaceInfos'));
    }

    public function postChannelEdit($channelId=null)
    {
        $inputs = Input::all();
        if($channelId != null)
            $ret = $this->channel->updateWechatChannel($channelId, $inputs);
        else
            $ret = $this->channel->saveWechatChannel($inputs);

        if($ret) return $this->redirectBack(['success'=>1]);
    }
}