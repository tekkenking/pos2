<?php namespace App\Libs\Repos;

use App\Models\Product as Model;
use App\Libs\Repos\BaseRepo;

class ProductRepo extends BaseRepo
{
	public function boot()
	{
		return new Model;
	}
}