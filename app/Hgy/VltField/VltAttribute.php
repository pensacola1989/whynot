<?php namespace Hgy\VltField;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/26/14
 * Time: 12:40 AM
 */
use McCool\LaravelAutoPresenter\PresenterInterface;
use Hgy\Core\Entity;

class VltAttribute extends Entity implements PresenterInterface {

    protected $table = 'volinfo_attribute';

    protected $guarded = [];
    /**
     * Get the presenter class.
     *
     * @return string The class path to the presenter.
     */
    public function getPresenter()
    {
        return VltAttributePresenter::class;
    }
}