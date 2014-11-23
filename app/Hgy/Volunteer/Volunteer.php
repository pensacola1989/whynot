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


    public function VoluteerGroup()
    {
        return $this->belongsTo('VolunteerGroup','groupd_id');
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