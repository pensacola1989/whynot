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


}