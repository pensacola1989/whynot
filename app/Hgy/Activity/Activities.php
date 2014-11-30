<?php namespace Hgy\Activity;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 3:01 PM
 */

use Hgy\Core\Entity;
use Hgy\Volunteer\Volunteer;
use McCool\LaravelAutoPresenter\PresenterInterface;

class Activities extends Entity implements PresenterInterface {

    protected $table = 'activities';

    protected $guarded = array('_token');

    public function ActivityComplete()
    {
        return $this->hasOne(ActivityComplete::class,'cpl_activity_id');
    }

    /**
     * 指向activity_attribute_value 表，产生一条纪录意味着有人报名
     */
    public function Attendees()
    {
        return $this->belongsToMany(Volunteer::class,'activity_attrvalue','activity_id','uid')
                    ->withPivot(['value']);
    }
    /**
     * @return bool 完成返回true
     */
    public function isFinished()
    {
        $endTimestamp = intval(strtotime(self::end_time));
        return time() > $endTimestamp;
    }

    /**
     * Get the presenter class.
     *
     * @return string The class path to the presenter.
     */
    public function getPresenter()
    {
        return ActivityPresenter::class;
    }
}