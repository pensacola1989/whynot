<?php
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 12/3/14
 * Time: 1:55 AM
 */

use Hgy\Activity\AtSignRepository;

class AtSignController extends BaseController {

    protected $layout = 'layouts.home';

    private $signs;

    public function __construct(AtSignRepository $atSignRepository)
    {
        $this->signs = $atSignRepository;
    }

    public function index($activityId)
    {
        $attendWithPivot = $this->signs->getSignVolunteers($activityId);
        $this->view('activity.activity_sign',compact('attendWithPivot'));
    }
}