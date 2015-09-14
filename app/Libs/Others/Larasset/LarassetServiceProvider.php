<?php namespace Libs\Larasset;

use Illuminate\Support\ServiceProvider;
use App;

class LarassetServiceProvider extends ServiceProvider
{
	public function register(){

	// Register 'Larasset' instance container to our Larasset object
		//$this->app['larasset'] = $this->app->share(function($app){
		//	return new \libs\Larasset\Larasset;
		//});

		App::bind('larasset', function(){
			return new \Libs\Larasset\Larasset;
		});


		// Shortcut so developers don't need to add an Alias in app/config/app.php
		$this->app->booting(function(){
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();

			$loader->alias('Larasset', 'Libs\Larasset\larassetFacade\Larasset');
		});

	}
}