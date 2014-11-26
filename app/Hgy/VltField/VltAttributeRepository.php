<?php namespace Hgy\VltField;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/26/14
 * Time: 1:49 AM
 */
use Hgy\Core\EntityRepository;
use Hgy\Account\User;

class VltAttributeRepository extends EntityRepository {

    public function __construct(VltAttribute $model)
    {
        $this->model = $model;
    }

    public function getAttributeInfoByOrg(User $user)
    {
        return $user->VltAttributes;
    }

}