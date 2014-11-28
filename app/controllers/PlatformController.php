<?php
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/28/14
 * Time: 1:21 AM
 */
use Hgy\Account\UserRepository;

class PlatformController extends BaseController {

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * 获取公益组织用户
     */
    public function GetOrgUsers()
    {

    }
}