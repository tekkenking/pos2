<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('auth/login', [
	'uses'	=>	'UsersController@showLogin',
	'as'	=>	'auth.login'
]);

Route::post('auth/login', [
	'uses'	=>	'UsersController@processLogin',
	'as'	=>	'auth.login'
]);

Route::get('auth/logout', [
	'uses'	=>	'UsersController@processLogout',
	'as'	=>	'auth.logout'
	]);

Route::group( [  'middleware' => 'auth'], function(){
		
		//Sales
		Route::group(['middleware' =>'role:sales', 'namespace' => 'Sales' ], function(){
			Route::get('/', [
				'uses'	=>	'HomeController@index',
				'as'	=>	'home'
			]);
		});

		//Administrator
		Route::group(['middleware' =>'role:admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function(){

			Route::get('/', [
				'uses'	=>	'DashboardController@index',
				'as'	=>	'admin.dashboard'
			]);

			Route::group(['prefix' => 'stock'], function(){

				//BRAND CONTROLLER
				Route::get('/', [
					'uses'	=>	'BrandsController@index',
					'as'	=>	'admin.brands.index'
				]);

				Route::get('create', [
					'uses'	=>	'BrandsController@create',
					'as'	=>	'admin.brands.create'
				]);

				Route::post('store', [
					'uses'	=>	'BrandsController@store',
					'as'	=>	'admin.brands.store'
				]);

				Route::get('edit/{id}', [
					'uses'	=>	'BrandsController@edit',
					'as'	=>	'admin.brand.edit'
				]);

				Route::post('update/{id}', [
					'uses'	=>	'BrandsController@update',
					'as'	=>	'admin.brand.update'
				]);

				Route::get('delete/{id}', [
					'uses'	=>	'BrandsController@destroy',
					'as'	=>	'admin.brand.delete'
				]);

				/*Route::get('status/{id}/{status}', [
					'uses'	=>	'BrandsController@toggleStatus',
					'as'	=>	'admin.brand.togglestatus'
				]);*/

				//PRODUCT CATEGORY CONTROLLER
				//Route::group(['prefix' => '{catid}'], function(){
					Route::get('/{brandid}', [
						'uses'	=>	'ProductCategoriesController@index',
						'as'	=>	'admin.cat.index'
					]);

					Route::get('/{brandid}/createcat', [
						'uses'	=>	'ProductCategoriesController@create',
						'as'	=>	'admin.cat.create'
					]);

					Route::post('/storecat', [
						'uses'	=>	'ProductCategoriesController@store',
						'as'	=>	'admin.cat.store'
					]);

					Route::get('/{catid}/editcat', [
						'uses'	=>	'ProductCategoriesController@edit',
						'as'	=>	'admin.cat.edit'
					]);					

					Route::post('/{catid}/updatecat', [
						'uses'	=>	'ProductCategoriesController@update',
						'as'	=>	'admin.cat.update'
					]);

					Route::get('/{catid}/delete', [
						'uses'	=>	'ProductCategoriesController@destroy',
						'as'	=>	'admin.cat.delete'
					]);					
				//});

				//PRODUCTS ROUTING
					Route::get('/{brandid}/{catid}', [
						'uses'	=>	'ProductsController@index',
						'as'	=>	'admin.product.index'
					]);

					Route::get('/{catid}/createproduct', [
						'uses'	=>	'ProductsController@create',
						'as'	=>	'admin.product.create'
					]);

					Route::post('/storeproduct', [
						'uses'	=>	'ProductsController@store',
						'as'	=>	'admin.product.store'
					]);

			});

			Route::group(['prefix' => 'settings'], function(){
				Route::get('/', [
					'uses'	=>	'SettingsController@index',
					'as'	=>	'admin.settings'
				]);

				Route::get('addroleform', [
					'uses'	=>	'SettingsController@addRoleForm',
					'as'	=> 	'admin.settings.addroleform'
				]);				

				Route::post('saverole', [
					'uses'	=>	'SettingsController@saveRole',
					'as'	=> 	'admin.settings.saverole'
				]);

				Route::get('assignroleform/{userid}', [
					'uses'	=>	'SettingsController@assignRoleForm',
					'as'	=> 	'admin.settings.assignroleform'
				]);	

				Route::post('saveassignrole/{userid}', [
					'uses'	=>	'SettingsController@saveAssignRole',
					'as'	=>	'admin.settings.saveassignrole'
				]);

			});

		});
	
});



