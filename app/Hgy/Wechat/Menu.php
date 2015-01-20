<?php namespace Hgy\Wechat;

use Hgy\Core\Entity;
use Hgy\Core\EntityRepository;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/20/15
 * Time: 3:42 PM
 */

class Menu extends  Entity {

    protected $table = 'wechat_menu';

    public $timestamps = false;

    protected $guarded = [];


}