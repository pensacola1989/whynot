<?php namespace Hgy\Activity;
use Hgy\Core\Entity;
use McCool\LaravelAutoPresenter\PresenterInterface;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 12/1/14
 * Time: 1:44 AM
 */

class ActivityAttributeValue extends Entity implements PresenterInterface {

    protected $table = 'activity_attrvalue';

    protected $guarded = [];

//    public function activities()
//    {
//        return $this->belongsToMany(Activities::class,'activity_attrvalue','uid', 'activity_id')
//            ->withPivot(['is_verify', 'value', 'vol_duration', 'vol_reply', 'at_reply']);
//    }
//
//    public function activityCount()
//    {
//        return $this->belongsToMany(Activities::class,'activity_attrvalue','uid', 'activity_id')
//            ->count();
//    }
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