<?php namespace Hgy\Facades;

use Illuminate\Support\Facades\Facade;


/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/5/15
 * Time: 2:30 AM
 */
class TemplateFunc extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'helper'; }

    public function test()
    {
        return 'from Facades';
    }
}