<?php namespace Hgy\Activity;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 3:01 PM
 */

use Hgy\Core\Entity;
class Activities extends Entity {
    protected $table = 'activities';

    protected $guarded = array('_token');

    public static $rules = array(
        'title'	=> 'required',
        'cover_id' => 'required',
        'start_time' => 'required',
        'end_time' => 'required',
        'area' => 'required',
        'content' => 'required'
    );
}