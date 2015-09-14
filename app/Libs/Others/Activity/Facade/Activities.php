<?php namespace  App\Libs\Others\Activity\Facade;


use Illuminate\Support\Facades\Facade;

class Activities extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'activities';
	}
}