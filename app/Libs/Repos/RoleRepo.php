<?php namespace App\Libs\Repos;

use Bican\Roles\Models\Role as Model;

use App\Libs\Repos\BaseRepo;

class RoleRepo extends BaseRepo
{
	public function boot()
	{
		return new Model;
	}

	public function checkThenCreate(Array $all)
	{
		$isExist = $this->findBy('slug', $all['slug'], ['id']);
		if( $isExist === null ){
			$this->create($all);
			return true;
		}else{
			return false;
		}
	}
}