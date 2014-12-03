<?php namespace Hgy\Activity;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 3:01 PM
 */
use Hgy\Core\Entity;
use McCool\LaravelAutoPresenter\PresenterInterface;

class ActivitySign extends Entity implements PresenterInterface {


    protected $table = 'activity_sign';


    public function Activities()
    {
        return $this->belongsToMany(Activities::class, 'sign_activity_id');
    }

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