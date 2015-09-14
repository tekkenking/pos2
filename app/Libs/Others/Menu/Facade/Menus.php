<?php namespace  App\Libs\Others\Menu\Facade;


use Illuminate\Support\Facades\Facade;

class Menus extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'menus';
	}
}