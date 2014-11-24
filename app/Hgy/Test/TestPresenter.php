<?php namespace Hgy\Test;

use McCool\LaravelAutoPresenter\BasePresenter;

class TestPresenter extends BasePresenter {

    public function __construct(Test $test)
    {
        $this->resource = $test;
    }


	public function created_at()
	{
		return $this->wrappedObject->created_at->toFormattedDateString();
	}
}