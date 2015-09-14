<?php namespace App\Libs\Repos;

use App\Models\Mode as Model;
use App\Libs\Repos\BaseRepo;

class ModeRepo extends BaseRepo
{
	public function boot()
	{
		return new Model;
	}

	public function allActive()
	{
		return $this->model->where('status', 1)->get(['id', 'name']);
	}
}