<?php namespace Hgy\Volunteer;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 3:03 PM
 */

use Hgy\Account\User;
use McCool\LaravelAutoPresenter\PresenterInterface;
use Hgy\Core\Entity;
use Hgy\VltField\VltAttributeValue;

class Volunteer extends Entity implements PresenterInterface {

    protected $table = 'volunteer';

    protected $guarded = [];

    public function VoluteerGroup()
    {
        return $this->belongsTo('Hgy\Volunteer\VolunteerGroup','groupd_id');
    }

    public function VolunteerAttrValues()
    {
        return $this->hasOne(VltAttributeValue::class,'vol_id');
    }

    // User表
    public function Organizations()
    {
        return $this->belongsToMany(User::class,'user_volunteer','vol_id','org_id')
                    ->withPivot(['group_id']);
    }

    public function belongUser()
    {
        return $this->belongsTo('Hgy\Account\User','org_id');
    }

    /**
     * Get the presenter class.
     *
     * @return string The class path to the presenter.
     */
    public function getPresenter()
    {
        return VolunteerPresenter::class;
    }
}