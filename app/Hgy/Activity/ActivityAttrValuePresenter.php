<?php namespace Hgy\Activity;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/13/15
 * Time: 1:00 AM
 */

use McCool\LaravelAutoPresenter\BasePresenter;

class ActivityAttrValuePresenter extends BasePresenter {

    public function __construct(ActivityAttributeValue $activityAttributeValue)
    {
        $this->resource = $activityAttributeValue;
    }


}