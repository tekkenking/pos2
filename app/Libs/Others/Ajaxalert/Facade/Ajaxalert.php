<?php namespace App\Libs\Others\Ajaxalert\Facade;

use Illuminate\Support\Facades\Facade;

class Ajaxalert extends Facade{

	protected static function getFacadeAccessor(){
		return 'ajaxalert';
	}
}