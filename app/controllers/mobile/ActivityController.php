<?php namespace mobile;

use Auth;
use Illuminate\Support\Facades\Input;
use Hgy\Activity\ActivityAttributeRepository;
use Hgy\Activity\ActivityRepository;
use Hgy\Activity\ActivityAttrValue;
use Illuminate\Support\Facades\Session;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 12/22/14
 * Time: 12:31 AM
 */

class ActivityController extends \BaseController {

    protected $layout = 'layouts.hgy_layout';

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
        $this->activity = $activityRepository;
        $this->activityAttribute = $activityAttribute;
        $this->activityAttrValue = $activityAttributeValue;
    }


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
     * @param $activity_id
     * @throws \Hgy\Core\Exceptions\EntityNotFoundException
     */
    public function atRegister($activity_id)
    {
        if(Session::get('msg'))
            echo '<script>alert("报名成功！");</script>';
        $isRegister = $this->activityAttrValue->isRegister(Auth::user()->id, $activity_id);
        $this->header = false;
        $activity = $this->activity->requireById($activity_id);
        $this->title = $activity->title;
        $attributes = $this->activityAttribute->getAttributeByActivityId($activity_id);
        if($isRegister) {
            $userData = $this->_parseUserData($activity_id,Auth::user()->id);
        }
//        header("Content-type: text/html; charset=utf-8");
//        dd($userData);exit();
        $this->view('mobile.activity_register',
            compact('userData', 'regDetail', 'activity', 'attributes', 'activity_id', 'isRegister'));
    }

    /**
     * 活动历史
     */
    public function atHistory()
    {
        $this->title = '活动历史';
        $this->header = false;

//        $ret = $this->activity->getHistoryActivityByUid(Auth::user()->id);
//        dd($ret);exit();
        $this->view('mobile.activity_history');
    }

    public function postAtRegister($activity_id)
    {
        $data = Input::all();
        $data = json_encode($data);
        $obj['activity_id'] = $activity_id;
        $obj['uid'] = Auth::user()->id;
        $obj['value'] = $data;

        $this->activityAttrValue->storeData($obj);
        return $this->redirectBack(['msg'=>'报名成功！']);
    }

    private function _parseUserData($activityId, $value)
    {
        $ret = [];
        $regDetail = $this->activityAttrValue->getAttrByUidAndAtId(Auth::user()->id, $activityId)->value;
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
}