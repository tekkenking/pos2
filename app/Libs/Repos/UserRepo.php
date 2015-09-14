<?php namespace App\Libs\Repos;

use App\Models\User as Model;
use App\Libs\Repos\BaseRepo;
use Hash;

class UserRepo extends BaseRepo
{
	public function boot()
	{
		return new Model;
	}
	
	public function userWithRoleAndPermissions()
	{
		return $this->model->select(['id', 'name', 'username'])
				->with(['roles'=>function($qr){
					return $qr->select('user_id', 'name', 'slug');
				}])
				->get();
	}

	public function listRoles($id)
	{
		return $this->find($id)->roles()->lists('name', 'slug');
	}

	public function syncRoles($id, Array $roleIds)
	{
		return $this->find($id)->roles()->sync($roleIds);
	}
	
}