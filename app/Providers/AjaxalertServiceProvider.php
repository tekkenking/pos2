<?php 

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;

class AjaxalertServiceProvider extends ServiceProvider
{
	public function register(){

		App::bind('ajaxalert', function(){
			return new \App\Libs\Others\Ajaxalert\Ajaxalert;
		});


		// Shortcut so developers don't need to add an Alias in app/config/app.php
		$this->app->booting(function(){
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();

			$loader->alias('Ajaxalert', 'App\Libs\Others\Ajaxalert\Facade\Ajaxalert');
		});

	}
}