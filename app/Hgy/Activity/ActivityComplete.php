<?php namespace Hgy\Activity;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 3:01 PM
 */
use Hgy\Core\Entity;

class ActivityComplete extends Entity {
    protected $table = 'activity_complete';

    public $autoPurgeRedundantAttributes = true;

    protected $guarded = [];

    public static $rules = array(
        'cpl_activity_duration'				=> 'required|digits_between:0,6',
        'cpl_activity_des'              => 'required|alpha_num|max:255'
    );
    /**
     * Get the presenter class.
     *
     * @return string The class path to the presenter.
     */
    public function getPresenter()
    {
        return ActivityCompletePresenter::class;
    }
}