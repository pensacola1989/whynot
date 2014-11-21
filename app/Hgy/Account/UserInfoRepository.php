<?php namespace Hgy\Account;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/20/14
 * Time: 11:06 PM
 */

use Hgy\Core\EntityRepository;

class UserInfoRepository extends EntityRepository {

    public function __construct(UserInfo $userInfo)
    {
        $this->model = $userInfo;
    }

    public function getError()
    {
        return $this->errorMessage;
    }
}