<?php namespace Hgy\Activity;
use McCool\LaravelAutoPresenter\PresenterInterface;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 3:01 PM
 */
class Activity_complete extends Entity implements PresenterInterface{
    protected $table = 'activity_complete';

    /**
     * Get the presenter class.
     *
     * @return string The class path to the presenter.
     */
    public function getPresenter()
    {
        // TODO: Implement getPresenter() method.
    }
}