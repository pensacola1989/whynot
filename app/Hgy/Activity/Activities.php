<?php namespace Hgy\Activity;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 3:01 PM
 */

use Hgy\Core\Entity;
use McCool\LaravelAutoPresenter\PresenterInterface;

class Activities extends Entity implements PresenterInterface {
    protected $table = 'activities';

    protected $guarded = array('_token');


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