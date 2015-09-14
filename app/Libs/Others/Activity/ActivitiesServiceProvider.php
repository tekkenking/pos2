<?php namespace App\Libs\Others\Activity;

use Illuminate\Support\ServiceProvider;
use App;

class ActivitiesServiceProvider extends ServiceProvider
{
	public function register(){

		App::bind('activities', function(){
			return new \App\Libs\Others\Activity\Activities;
		});


		// Shortcut so developers don't need to add an Alias in app/config/app.php
		$this->app->booting(function(){
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();

			$loader->alias('Activity', 'App\Libs\Others\Activity\Facade\Activities');
		});

	}
}