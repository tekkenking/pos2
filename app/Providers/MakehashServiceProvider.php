<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MakehashServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
	public function register(){

		$this->app->bind('makehash', function(){
			return new \App\Libs\Others\Makehash\Makehash;
		});


		// Shortcut so developers don't need to add an Alias in app/config/app.php
		$this->app->booting(function(){
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();

			$loader->alias('Makehash', 'App\Libs\Others\Makehash\Facade\Makehash');
		});

	}
}
