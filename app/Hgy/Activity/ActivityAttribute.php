<?php namespace Hgy\Activity;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 3:01 PM
 */
use Hgy\Core\Entity;
class ActivityAttribute extends Entity {
    protected $table = 'activity_attribute';

    protected $guarded = array('_token');

    public static $rules = array(
        'attr_name'	=> 'required|',
        'attr_type' => 'required',
        'attr_title' => 'required',
        'is_must' => 'required'
    );

}