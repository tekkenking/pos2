<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LarassetServiceProvider extends ServiceProvider
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

		$this->app->bind('larasset', function(){
			return new \App\Libs\Others\Larasset\Larasset;
		});


		// Shortcut so developers don't need to add an Alias in app/config/app.php
		$this->app->booting(function(){
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();

			$loader->alias('Larasset', 'App\Libs\Others\Larasset\Facade\Larasset');
		});

	}
}
