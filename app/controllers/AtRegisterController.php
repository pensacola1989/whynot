<?php
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 12/3/14
 * Time: 11:50 PM
 */

use Hgy\Activity\ActivityRepository;
use Hgy\Activity\ActivityAttributeRepository;

class AtRegisterController extends BaseController {

    /**
     * @var response for Activity
     */
    private $activityRepo;

    /**
     * @var response for Activity_Attribute_value
     * 报名Repo
     */
    private $actAttrValue;

    protected $layout = 'layouts.home';

    public function __construct(ActivityRepository $activityRepository, ActivityAttributeRepository $activityAttributeRepository)
    {
        $this->activityRepo = $activityRepository;
        $this->actAttrValue = $activityAttributeRepository;
    }

    public function index($activityId)
    {
        $this->title = '审核报名';
        $registers = $this->activityRepo->getAttendeeInfo($this->getCurrentUser(), $activityId);
        $this->view('activity.activity_register', compact('registers', 'activityId'));
    }

    public function approveVlt($activityId)
    {
        // 审核还是否决
        $type = Input::get('type');
        $ids = Input::get('ids');
        $currentUser = $this->getCurrentUser();
        if(!count($ids))
            return ['errorCode' =>  102, 'message'  =>  '操作失败'];

        if(intval($type) == 1) $this->activityRepo->ApproveWithIds($currentUser, $activityId, $ids);
        else                   $this->activityRepo->RejectWithIds($currentUser, $activityId, $ids);

        return ['errorCode' =>  0, 'message'    =>  '操作成功'];

    }
}