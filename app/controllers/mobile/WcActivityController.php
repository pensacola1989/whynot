<?php namespace mobile;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Hgy\Activity\ActivityAttributeRepository;
use Hgy\Activity\ActivityRepository;
use Hgy\Activity\ActivityAttrValue;
use Illuminate\Support\Facades\Session;


class WcActivityController extends WechatMobileController {

    protected $layout = 'layouts.mobilelayout';

    /**
     * Activity 代理
     * @var
     */
    private $activity;
    /**
     * 报名字段代理
     * @var
     */
    private $activityAttribute;
    /**
     * @var字段值代理
     */
    private $activityAttrValue;

    public function __construct(ActivityRepository $activityRepository,
                                ActivityAttributeRepository $activityAttribute,
                                ActivityAttrValue $activityAttributeValue)
    {
        parent::__construct();
        $this->activity = $activityRepository;
        $this->activityAttribute = $activityAttribute;
        $this->activityAttrValue = $activityAttributeValue;
    }


    /**
     * 最新活动
     * @param $orgId
     */
    public function latest($orgId)
    {
        $this->title = '最新活动';
        $this->header = false;
        $lastAt = $this->activity->getLatestActivityByOrgId($orgId);
        $this->view('mobile.activity_new', compact('lastAt', 'orgId'));
    }

    /**
     * 活动报名
     * @param $activity_id
     * @throws \Hgy\Core\Exceptions\EntityNotFoundException
     */
    public function atRegister($activity_id)
    {
        if(Session::get('msg'))
            echo '<script>alert("报名成功！");</script>';
        $isRegister = $this->activityAttrValue->isRegister($this->getUidForHgy(), $activity_id);
        $this->header = false;
        $activity = $this->activity->requireById($activity_id);
        $this->title = $activity->title;
        $attributes = $this->activityAttribute->getAttributeByActivityId($activity_id);
        if($isRegister) {
            $userData = $this->_parseUserData($activity_id, $this->getUidForHgy());
        }
        $this->view('mobile.activity_register',
            compact('userData', 'regDetail', 'activity', 'attributes', 'activity_id', 'isRegister'));
    }

    /**
     * 活动历史
     * @param $orgId
     */
    public function atHistory($orgId)
    {
        $this->title = '活动历史';
        $this->header = false;
        $atHistory = $this->activity->getHistoryActivityByOrgId($orgId);

        $this->view('mobile.activity_history', compact('atHistory', 'orgId'));
    }

    public function postAtRegister($activity_id)
    {
        $data = Input::all();
        $data = json_encode($data);
        $obj['activity_id'] = $activity_id;
        $obj['uid'] = $this->getUid();
        $obj['value'] = $data;

        $this->activityAttrValue->storeData($obj);
        $this->activity->updateRequestNumbers($activity_id);
        return $this->redirectBack(['msg'=>'报名成功！']);
    }

    private function _parseUserData($activityId, $value)
    {
        $ret = [];
        $regDetail = $this->activityAttrValue->getAttrByUidAndAtId($this->getUidForHgy(), $activityId)->value;
        $regDetail = json_decode($regDetail, true);
        $attributes = $this->activityAttribute->getAttributeByActivityId($activityId);
        foreach($attributes as $attr) {
            if($attr->attr_type == 'enum') {
                $fieldValue = $regDetail[$attr->attr_field_name];
                $retValue = $this->_mapEnum($attr->attr_extra,$fieldValue);
                $ret[$attr->attr_field_name] = $retValue;
            }
            else if($attr->attr_type == 'radio') {
                $ret[$attr->attr_field_name] = $this->_mapRadio($attr->attr_extra,
                    $regDetail[$attr->attr_field_name]);
            }
        }
        return $ret;
    }

    private function _mapEnum($str, $arr)
    {
        if(empty($str) || $str == '') return;
        $map = [];
        $ret = '';
        $itemArr = explode(',', $str);
        foreach($itemArr as $item) {
            list($k, $value) = explode(':', $item);
            $map[$k] = $value;
        }

        foreach($arr as $a) {
            $ret .= $map[$a] . ',';
        }
        return $ret;
    }

    private function _mapRadio($str, $key)
    {
        if(empty($str) || $str == '') return;
        $map = [];
        $itemArr = explode(',', $str);
        foreach($itemArr as $item) {
            list($k, $v) = explode(':', $item);
            $map[$k] = $v;
        }
        return $map[$key];
    }

    /**
     * 需要签到的列表
     */
    public function getNeedSign($orgId)
    {
        // 活动没开始
        // 用户没签到
        $this->title = '签到';
        $this->header = false;
        $needSign = $this->activity->getUserNeedSignByOrgId($orgId, $this->getUid());
        $this->view('mobile.activity_sign',compact('needSign', 'orgId'));
    }

    /**
     * 签到写入
     */
    public function postSign()
    {
        $activityId = intval(Input::get('activity_id'));
        $signCode = Input::get("sign_code");
        if($this->activity->isSignCodeMatch($signCode, $activityId)) {
            $this->activity->signActivity($this->getUid(), $activityId);
            return ['errorCode'=>0, 'message'=>'签到成功'];
        } else {
            return ['errorCode'=>101, 'message'=>'操作失败'];
        }
    }

    /**
     * 签到页面
     */
    public function getSign($activityId)
    {
        $this->title = '签到页面';
        $this->header = false;

        $isSign = $this->activity->isSigned($this->getUid(), $activityId);
        $this->view('mobile.sign_detail', compact('activityId', 'isSign'));
    }

    /**
     * 二维码签到
     */
    public function qrSign($activityId)
    {
        $this->activity->signActivity($this->getUid(), $activityId);
        return '签到成功';
    }
}