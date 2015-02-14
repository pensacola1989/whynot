<?php namespace Hgy\Image;

use Hgy\Core\EntityRepository;
use Illuminate\Support\Facades\URL;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 12/7/14
 * Time: 1:38 AM
 */

class ImageRepository extends EntityRepository {

    const URL_BASE = 'uploadFile/';

    public function __construct(Image $model)
    {
        $this->model = $model;
    }
    public function addImage($filename)
    {
        $imgObj = $this->storeData(['filename' =>  $filename]);
//        return $this->save($imgObj);
        return $imgObj;
    }

    public function storeData($data)
    {
        $user = $this->getNew($data);
        $ret = $this->save($user);
        if(!$ret)  {
            $this->errorMessage = $user->errors();
        } else {
//            $this->_setDefaultRole($user);
            return $user;
        }
    }

    public function getImageUrlById($imageId)
    {
        return URL::asset(self::URL_BASE  . $this->requireById($imageId)->filename);
    }
}