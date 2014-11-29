<?php namespace Hgy\Activity;
use Hgy\Core\EntityRepository;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/30/14
 * Time: 2:47 AM
 */

class ActivitySummaryRepository extends EntityRepository {

    public function __construct (Activity_complete $model)
    {
        $this->model = $model;
    }

    public function getSummaryPaginate()
    {

    }
}