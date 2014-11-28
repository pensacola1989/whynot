<?php
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/28/14
 * Time: 11:55 PM
 */

namespace Hgy\Org;


class OrganizationRepository {

    public function __construct(Organization $model)
    {
        $this->model = $model;
    }

} 