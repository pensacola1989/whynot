<?php
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/23/14
 * Time: 11:28 PM
 */
use Hgy\Volunteer\VolunteerRepository;

class VolunteerController extends BaseController {

    /**
     * per page num
     */
    const PER_PAGE_NUM = 10;
    /**
     * lock status code
     */
    const VLT_STATUS_LOCK = 4;
    /**
     * verifying
     */
    const VLT_STATUS_VRF = 2;
    /**
     * already verified
     */
    const VLT_STATUS_VRFD = 1;
    /**
     * default status
     */
    const VLT_STATUS_NOVRF = 0;
    /**
     * refuse the attempt
     */
    const VLT_STATUS_RFS = -1;

    protected $layout = 'layouts.home';
    /**
     * @var volunteers repository
     */
    private $volunteers;

    public function __construct(VolunteerRepository $volunteerRepository)
    {
        $this->volunteers = $volunteerRepository;
    }

    public function GetVolunteers()
    {
        $currentUser = $this->getCurrentUser();
        $volunteers = $this->volunteers->getByBisUser($currentUser);
        $groups = $this->_getGroups();
        $this->view('volunteer.index',compact('volunteers','groups'));
    }

    private function _getGroups()
    {
        return $this->getCurrentUser()->volunteerGroup;
    }


    /**
     * andWhere search
     * both conditions should meet
     */
    public function GetVolSearch()
    {
        $currentUser = $this->getCurrentUser();
        $groupOfUser = $currentUser->volunteerGroup;
        $searchFieldArr = Input::query();
        $query = array_except($searchFieldArr,\Illuminate\Support\Facades\Paginator::getPageName());
        $repo = App::make('Hgy\Volunteer\VolunteerSearch');
        $volunteers = $repo->searchPaginated($currentUser,$query,self::PER_PAGE_NUM);
        $this->view('volunteer.search',['volunteers' => $volunteers, 'groups' => $groupOfUser, 'query' => $searchFieldArr]);
    }

    public function LockVolunteer()
    {
        $vltid = Input::get('vltid');
    }
}