<?php  namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;

class MenuServiceProvider extends ServiceProvider
{
	public function register(){

		App::bind('menus', function(){
			return new \App\Libs\Others\Menu\Menus;
		});


		// Shortcut so developers don't need to add an Alias in app/config/app.php
		$this->app->booting(function(){
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();

			$loader->alias('Menus', 'App\Libs\Others\Menu\Facade\Menus');
		});

	}
}