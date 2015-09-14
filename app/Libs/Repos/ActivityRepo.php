<?php namespace App\Libs\Repos;

use App\Models\Useractivity as Model;
use App\Libs\Repos\BaseRepo;

class ActivityRepo extends BaseRepo
{
	public function boot()
	{
		return new Model;
	}
}