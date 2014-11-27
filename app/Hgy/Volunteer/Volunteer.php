<?php namespace Hgy\Volunteer;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 3:03 PM
 */

use McCool\LaravelAutoPresenter\PresenterInterface;
use Hgy\Core\Entity;

class Volunteer extends Entity implements PresenterInterface {

    protected $table = 'volunteer';

    protected $guarded = [];

    public function VoluteerGroup()
    {
        return $this->belongsTo('Hgy\Volunteer\VolunteerGroup','groupd_id');
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