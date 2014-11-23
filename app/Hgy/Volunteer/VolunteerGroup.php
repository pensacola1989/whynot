<?php namespace Hgy\Volunteer;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/21/14
 * Time: 5:22 PM
 */


use Hgy\Core\Entity;

class VolunteerGroup extends Entity {

    protected $table = 'volunteergruops';

    protected $guarded = [];

    public static $rules = array(
        'group_name'				=> 'required|max:10|unique:volunteergruops'
    );

    public function Volunteers()
    {
        return $this->hasMany('Volunteer','groupd_id');
    }
}