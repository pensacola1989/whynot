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

class ActivityController extends BaseController {

    protected $layout = 'layouts.home';

    private $activityRepo;
    private $attributeRepo;

    public function __construct(ActivityRepository $repo,ActivityAttributeRepository $attrRepo)
    {
        $this->activityRepo = $repo;
        $this->attributeRepo = $attrRepo;
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

//    public function publish()
//    {
//        $this->title = '活动发布';
//        $this->view('activity.publish');
//    }

    public function summary()
    {
        $this->title = '活动总结';
        $this->view('activity.summary');
    }

    public function homeSearch(){
        $currentUser = $this->getCurrentUser();
        $groupOfUser = $currentUser->volunteerGroup;

    }

    /**
     * publish page
     */
    public function publish($step=null,$uid=null)
    {
//        if(!$step) return $this->redirectAction('ActivityController@publish');
        $step = !empty($step) ? $step : 1;
        if($step == 1) {
            $this->title = '基本信息';
            $this->view('Activity.publish',['step' => $step]);
        } elseif($step == 2 && $uid != null) {
//            try {
//                $this->userRepo->requireById($uid);
//            } catch(Exception $e) {
//                return $this->redirectAction('ActivityController@publish');
//            }
            $this->title = '报名信息设计';
            $this->view('Activity.publish',['step' => $step,'uid' => $uid]);
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
            $attrArray = Input::get('attrJson');
            try {
                foreach ($attrArray as $value) {
                    $value['activit_id'] = $uid;
                    $newAttr = $this->attributeRepo->storeData($value);
                }
            }catch(Exception $e){
                return $e;
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
                $newActivity = $this->activityRepo->storeData($input);
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
}
