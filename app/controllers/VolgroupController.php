<?php
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/22/14
 * Time: 3:04 PM
 */
use Hgy\Account\UserRepository;
use Hgy\Volunteer\VolunteerGroupRepository;

class VolgroupController extends BaseController {

    private $volGroup;

    protected $layout = 'layouts.home';

    public function __construct(VolunteerGroupRepository $volGroup,UserRepository $user)
    {
        $this->volGroup = $volGroup;
        $this->user = $user;
    }

    public function GetGroup()
    {
        $this->title = '志愿者分组';
        $group = $this->volGroup->GetGruopByBisId(Auth::user()->id);
        $this->view('group.list', ['group'  =>  $group]);
    }

    public function PostGroup()
    {
        $bisUser = $this->user->requireById(Auth::user()->id);
        $newGroup = $this->volGroup->getNew(Input::only('group_name'));
        if(!$newGroup->validate())
            return $this->redirectBack(['errors' => $newGroup->errors()]);
        $bisUser->volunteerGroup()->save($newGroup);
        return $this->redirectAction('VolgroupController@GetGroup');
    }

    public function PostShow($id=null)
    {
        $group = null;
        $isEdit = $id != null;
        $this->title = !$isEdit ? '添加志愿者分组' : '修改分组';
        if($id != null) {
            $group = $this->volGroup->requireById($id);
        }
//        echo ;;exit();
        $this->view('group.postshow',['isEdit' => $isEdit,'group' => $group]);
    }

    public function PostEdit()
    {
        $id = Input::get('id');
        $user = $this->user->requireById(Auth::user()->id);
        $group = $this->volGroup->requireById($id);
        $group->group_name = Input::get('group_name');
        if(!$group->validate())
            return $this->redirectBack(['errors' => $group->errors()]);
        $ret = $user->volunteerGroup()->save($group);
        if($ret)
            return $this->redirectAction('VolgroupController@GetGroup');
    }
}