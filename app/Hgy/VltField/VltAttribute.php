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

    public static $rules = [
        'attr_name'				=> 'required|between:0,16',
        'attr_field_name'       => 'required|alpha_num',
        'attr_des'              => 'required|alpha_num|between:4,120'
    ];
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