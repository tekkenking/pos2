<?php namespace App\Libs\Others\Larasset\Facade;

use Illuminate\Support\Facades\Facade;

class Larasset extends Facade{

	protected static function getFacadeAccessor(){
		return 'larasset';
	}
}