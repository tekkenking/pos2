<?php namespace Libs\Ajaxalert;

use Illuminate\Support\ServiceProvider;
use App;

class AjaxalertServiceProvider extends ServiceProvider
{
	public function register(){

	// Register 'ajaxAlert' instance container to our ajaxAlert object
		//$this->app['ajaxalert'] = $this->app->share(function($app){
		//	return new \Libs\Ajaxalert\Ajaxalert;
		//});

		App::bind('ajaxalert', function(){
			return new \Libs\Ajaxalert\Ajaxalert;
		});


		// Shortcut so developers don't need to add an Alias in app/config/app.php
		$this->app->booting(function(){
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();

			$loader->alias('Ajaxalert', 'Libs\Ajaxalert\ajaxalertFacade\Ajaxalert');
		});

	}
}