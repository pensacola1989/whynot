<?php namespace Hgy\VltField;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 3:03 PM
 */
use App,Auth;
use McCool\LaravelAutoPresenter\BasePresenter;

class VltAttributePresenter extends BasePresenter {

    public function __construct(VltAttribute $attribute)
    {
        $this->resource = $attribute;
    }

}