<?php namespace Hgy\Account;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/18/14
 * Time: 9:34 PM
 */

 use Hgy\Core\EntityRepository;

class UserRepository extends EntityRepository {

//    private $errorMessage;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function storeData($data)
    {

        $user = $this->getNew($data);
//        $model->password = \Hash::make($model->password);
        $ret = $this->save($user);
        if(!$ret)
        {
            $this->errorMessage = $user->errors();
        }
        else
        {
            return $user;
        }
    }

    public function getError()
    {
        return $this->errorMessage;
    }
}