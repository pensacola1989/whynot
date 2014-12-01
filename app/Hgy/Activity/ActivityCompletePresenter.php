<?php namespace Hgy\Activity;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/30/14
 * Time: 11:28 PM
 */


class ActivityCompletePresenter extends \McCool\LaravelAutoPresenter\BasePresenter {

    /**
     * @param \Hgy\Activity\ActivityComplete $activityComplete
     */
    public function __construct(ActivityComplete $activityComplete)
    {
        $this->resource = $activityComplete;
    }
}