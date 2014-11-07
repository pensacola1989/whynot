<?php namespace Hgy\Test;

use Hgy\Core\EntityRepository;
use LaravelBook\Ardent\Ardent;

class TestRepository extends EntityRepository{

	// private $model;

	private $errorsMsg;

	public function __construct(Test $model)
	{
		$this->model = $model;
	}

    public function storeData($data) 
    {
        $test = $this->getNew($data);

        $ret = $this->save($test);
        
        if(!$ret) 
        {
            $this->errorsMsg = $test->errors();
        }

        return $ret;
    }
}