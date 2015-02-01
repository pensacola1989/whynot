<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 11/24/14
 * Time: 8:59 PM
 */

use Hgy\Activity\ActivityPresenter;
use Hgy\Activity\ActivityRepository;
use Hgy\Activity\ActivityAttributeRepository;
use Hgy\Wechat\QrCodeHelper;
use Hgy\Wechat\ChannelRepository;

class ActivityController extends BaseController {

    protected $layout = 'layouts.home';

    private $activityRepo;
    private $attributeRepo;
    private $qrHelper;
    private $channelRepo;

    private $fieldTypeMap = [
        'datetime'  =>  '日期类型',
        'text'      =>  '文本类型',
        'enum'      =>  '枚举类型',
        'email'     =>  'email类型',
        'textarea'   =>  '多文字',
        'image'     =>  '图片'
    ];

    public function __construct(ActivityRepository $repo,
                                ActivityAttributeRepository $attrRepo,
                                QrCodeHelper $qrCodeHelper,
                                ChannelRepository $channelRepository)
    {
        $this->activityRepo = $repo;
        $this->attributeRepo = $attrRepo;
        $this->qrHelper = $qrCodeHelper;
        $this->channelRepo = $channelRepository;
    }

    public function index()
    {
        $this->title = '活动情况';
        $this->view('activity.index');
    }

    public function manage()
    {
        $this->title = '活动管理';
        $activities = $this->activityRepo->getActivities($this->getCurrentUser());
        $this->view('activity.manage', compact('activities'));
    }


    public function summary()
    {
        $this->title = '活动总结';
        $this->view('activity.summary');
    }

    public function homeSearch(){
        $currentUser = $this->getCurrentUser();
        $groupOfUser = $currentUser->volunteerGroup;

    }

    public function publishActivity()
    {
        $activityId = Input::get('activityId');
        if($this->activityRepo->publishAt($activityId))
            return ['errorCode' =>  0,  'message'   =>  '操作成功'];
    }

    public function editAtInfo($id=null)
    {
        $fieldTypeMap = $this->fieldTypeMap;
        $viewType = $id == null ? 'add' : 'edit';
        $data = null;
        if($id != null) {
            $data = $this->attributeRepo->requireById($id);
        }
        $this->view('activity.atInfoEdit',compact('data','viewType','fieldTypeMap'));
    }

    public function postDelete()
    {
        $id = Input::get('id');
        if($ret = $this->attributeRepo->requireById($id)) {
            $ret->delete();
            return ['errorCode' =>  0, 'message'    =>  '删除成功'];
        }
    }

    public function postUpdateSort()
    {
        // error 102 => 缺少参数
        $sortIdArr = Input::get('idSorts');
        if($sortIdArr == null)
            return ['errorCode' => 102, 'message' => '缺少参数'];
        $sortIdArr = json_decode($sortIdArr);
        $this->attributeRepo->updateSortByIdSorts($sortIdArr);
        return ['errorCode' => 0, 'message' => '更新排序成功'];
    }

    public function postEditInfo($id=null)
    {
        $newModel = $this->attributeRepo->getNew(Input::all());
        if(!$newModel->validate())
            return $this->redirectBack(['errors'    =>  $newModel->errors()]);
        if($id == null) {
//            $this->getCurrentUser()->VltAttributes()->save($newModel);
            $this->attributeRepo->saveAttributes(Session::get('currentActivityId'), $newModel);
            return $this->redirectAction('ActivityController@publish', ['step'  =>  2,
                'uid'    =>  Session::get('currentActivityId')]);
        }
        $this->attributeRepo->UpdateAttributeInfoById($id, Input::all());
        return $this->redirectAction('ActivityController@publish', ['step'  =>  2,
            'uid'    =>  Session::get('currentActivityId')]);
    }

    /**
     * publish page
     * @param null $step
     * @param null $uid
     */
    public function publish($step=null,$uid=null)
    {
//        if(!$step) return $this->redirectAction('ActivityController@publish');
        $step = !empty($step) ? $step : 1;
        if($step == 1) {
            $this->title = '基本信息';
            $this->view('Activity.publish',['step' => $step, 'uid'  =>  $uid]);
        } elseif($step == 2 && $uid != null) {
            Session::put('currentActivityId', $uid);
            $attrs = $this->activityRepo->getAttrByOrderNum($uid);
            $orgId = Auth::user()->Orgs()->first()->id;
            $this->title = '报名信息设计';
            $this->view('activity.activity_info', compact('attrs', 'uid', 'orgId'));
        } elseif($step == 3 && $uid != null) {
//            $isVerify = $this->_isUserVery($uid);
            $this->title = '发布渠道选择';
            $this->view('Activity.publish',['step' => $step]);
        }
        else {
            $this->title = '基本信息';
            $this->view('Activity.publish',['step' => 1]);
        }

    }

    /**
     * add a activity
     */
    public function add($step=null,$uid=null)
    {
        if (Request::ajax()) {
            $jsonStr = Input::get('attrJson');
            $activityId = Input::get('activityId');
            if($obj = json_decode($jsonStr, true)) {
                $this->attributeRepo->saveAttributes($activityId, $obj);
            }


        }else{
            if (Input::hasFile('imgFile'))
            {
                $file = Input::file('imgFile');
            }
            $step = Input::get('step');
            $step = !empty($step) ? $step : 1;
            if ($step == 1) {
                $input = Input::except('step');
                $newActivity = $this->activityRepo->saveNewActivity($this->getCurrentUser(), $input);
                if ($newActivity) {
                    return $this->redirectAction('ActivityController@publish', ['step' => 2, 'uid' => $newActivity->id]);
                }else {
                    return $this->redirectBack(['errors' => $this->activityRepo->getError()]);
                }
            }
        }
        if($step == 2) {

//            if($uid == null)
//                return $this->redirectAction('ActivityController@publish');
//            if($user = $this->userRepo->requireById($uid)) {
//                $userinfo = $this->userInfo->getNew(Input::except('step'));
//                if(!$userinfo->validate())
//                    return $this->redirectBack(['errors'=>$userinfo->errors()]);
//                $user->userinfos()->save($userinfo);
//                return $this->redirectAction('ActivityController@publish',['step'=>3,'uid'=>$user->id]);
//            }
        }

    }

    /**
     * @param $activityId
     * @param $orgId
     */
    public function publishChannel($activityId, $orgId)
    {
        $this->title = '活动发布渠道';
        $isActivityVerified = $this->activityRepo->isActicityVerified($activityId);
        $getQrImgUrl = URL::action('ActivityController@getSignQrCodeImg', [$activityId, $orgId]);
        $isPublished = $this->activityRepo->isActivityPublished($activityId);
        $sns = $this->channelRepo->getSnsKeyInfo();
        if($sns != null && $sns->sns_key_info != null) {
            $snsKeyInfo = json_decode($sns->sns_key_info);
        }
        else {
            $snsKeyInfo = null;
        }
        $this->view('activity.activity_pub_channel',
            compact('getQrImgUrl', 'isPublished', 'isActivityVerified', 'activityId', 'snsKeyInfo'));
    }

    /** 浏览器端图片的src地址，动态生成二维码
     * @param $activityId
     * @param $orgId
     * @return mixed
     */
    public function getSignQrCodeImg($orgId, $activityId)
    {
        $signUrl = URL::action('mobile\WcActivityController@qrSign', [$activityId, $orgId]);
        $qrImg = $this->qrHelper->generateQrCode($signUrl, 200);
        $response = Response::make($qrImg, 200);
        $response->header('content-type', 'image/png');
        return $response;
    }

    public function atDetail($activityId, $orgId)
    {
        $this->title = '活动详情';
        $activities = $this->activityRepo->requireById($activityId);
        $activityAttr = $activities->Attributes;
        $this->view('activity.at_detail', compact('activities', 'activityAttr'));
    }

    /** 修改活动基本信息
     * @param $activityId
     */
    public function getModifyActvityInfo($activityId)
    {
        $this->title = '修改活动基本信息';
        $activity = $this->activityRepo->requireById($activityId);
        $this->view('activity.modify_activity', compact('activity'));
    }

    /** 编辑活动基本信息
     * @param $activityId
     * @return array
     */
    public function postActivityEdit($activityId)
    {
        $activity = $this->activityRepo->requireById($activityId);
        $ret = $activity->update(\Illuminate\Support\Facades\Input::all());
        if ($ret) {
            return $this->redirectAction('ActivityController@atDetail',
                [Auth::user()->Orgs()->first()->id, $activityId]);
        }
        else {
            return $this->redirectAction('ActivityController@atDetail',
                [Auth::user()->Orgs()->first()->id, $activityId]);
        }
    }

    public function filter()
    {
        $this->title = '活动管理';
        $searchFieldArr = Input::query();
        if(count($searchFieldArr) == 0 || empty($searchFieldArr['filter'])) {
            $activities = $this->activityRepo->getActivities($this->getCurrentUser());
        } else {
            $query = array_except($searchFieldArr,\Illuminate\Support\Facades\Paginator::getPageName());

            $activities = $this->activityRepo->searchPaginated($this->getCurrentUser(), $query, 5);
        }

        $this->view('activity.manage', compact('activities', 'searchFieldArr'));
    }
}
