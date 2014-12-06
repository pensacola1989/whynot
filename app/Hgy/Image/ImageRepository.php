<?php namespace Hgy\Image;

use Hgy\Core\EntityRepository;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 12/7/14
 * Time: 1:38 AM
 */

class ImageRepository extends EntityRepository {

    public function __construct(Image $model)
    {
        $this->model = $model;
    }
    public function addImage($filename)
    {
        $imgObj = $this->getNew(['filename' =>  $filename]);
        return $this->save($imgObj);
    }
}