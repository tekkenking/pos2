<?php namespace  App\Libs\Others\Menu;

use stdClass;

class Menus
{
	private $std;

	public function get()
	{
		return [
			'dashboard' => [
				'name'		=> 	'Dashboard',
				'url'		=>	'admin.dashboard',
				'role'		=>	'admin',
				'icon'		=>	'fa fa-th-large text-danger'
			],

			'stocks'		=>	[
				'name'		=>	'Stocks',
				'url'		=>	'admin.brands.index',
				'role'		=>	'stockmanager',
				'icon'		=>	'fa fa-cubes text-danger'
			],

			'reports'	=> [
				'name'		=> 	'Reports',
				'url'		=>	'admin.dashboard',
				'role'		=>	'admin',
				'icon'		=>	'fa fa-file-text text-danger',
				'submenu'	=> [
					'sales_report'	=> [
						'name'	=>	'Sales',
						'url'	=>	'admin.dashboard',
						'role'	=>	'admin',
						'icon'	=>	'fa fa-paper-plane-o text-danger'
					]
				]
			],

			'cart'		=> [
				'name'		=>	'Cart place',
				'url'		=>	'home',
				'role'		=>	'sales',
				'icon'		=>	'fa fa-shopping-cart text-danger'
			],

			'settings'	=>[
				'name'		=>	'Settings',
				'url'		=>	'admin.settings',
				'role'		=>	'admin',
				'icon'		=>	'fa fa-cog text-danger'
			]
		];
	}
}