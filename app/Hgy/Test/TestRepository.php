<?php namespace Hgy\Test;

use LaravelBook\Ardent\Ardent;

class TestRepository {

	private $model;

	private $errorsMsg;

	public function __construct(Test $model)
	{
		$this->model = $model;
	}

	public function getErrorMsg()
	{
		return $this->errorsMsg;
	}

	public function getAll()
	{
		return $this->model->all();
	}

	public function getNew($attributes = array())
    {
        return $this->model->newInstance($attributes);
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

    public function save($data)
    {
        if ($data instanceOf Test) {
            return $this->storeEloquentModel($data);
        } elseif (is_array($data)) {
            return $this->storeArray($data);
        }
    }


    public function delete($model)
    {
        return $model->delete();
    }

    protected function storeEloquentModel($model)
    {
        if ($model->getDirty()) {
            return $model->save();
        } else {
            return $model->touch();
        }
    }

    protected function storeArray($data)
    {
        $model = $this->getNew($data);
        return $this->storeEloquentModel($model);
    }
}