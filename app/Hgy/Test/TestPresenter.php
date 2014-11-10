<?php namespace Hgy\Test;

use McCool\LaravelAutoPresenter\BasePresenter;

class TestPresenter extends BasePresenter {

	public function created_at()
	{
		return $this->resource->created_at->toFormattedDateString();
	}
}