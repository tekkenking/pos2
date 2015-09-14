<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Larasset, Auth;

use Appkr\Fractal\Http\ApiResponse;

class BaseController extends Controller
{
	use ApiResponse;
	
	public $layout = 'layouts.master';
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct()
    {
       // dd('spade');
	   $this->assets();
    }
	
	protected function assets()
	{
		Larasset::start()->vendor_dir = '/assets/';
		
		$css = [
			'bucketcodes/css' 	=> [
				'fonts'			=>	'fonts.css',
				'app'			=>	'app.css',
				'styledcheckbox'=>	'styledcheckbox.css'
			],
			
			'inspinia_2.3/css'	=> [
				'bootstrap'		=>	'bootstrap.min.css',
				'animate'		=>	'animate.css',
				'style'			=>	'style.css',
				'datatable_bootstrap'	=>	'plugins/dataTables/dataTables.bootstrap.css',
				'datatable_responsive'	=>	'plugins/dataTables/dataTables.responsive.css',
				'datatable_tableTools'	=>	'plugins/dataTables/dataTables.tableTools.min.css',
				'sweetalert'	=>	'plugins/sweetalert/sweetalert.css'

			],

			'font_awesome/css'	=>	[
				'font-awesome'	=>	'font-awesome.css'
			],

			'ionicons/css'		=>	[
				'ionicons'		=>	'ionicons.min.css'
			],

			'maggicsuggest_2.0'		=>	[
				'maggicsuggest'		=>	'css/maggicsuggest.min.css'
			]
		];
		
		$js = [
			'bucketcodes/js'	=>	[
				'validater'		=>	'validater.js',
				'freset'		=>	'freset.js',
				'ajaxrequest'	=>	'ajax-request-lite.js',
				'styledcheckbox'=>	'styledcheckbox.js'
			],

			'inspinia_2.3/js'	=>	[
				'jquery'		=>	'jquery-2.1.1.js',
				'bootstrap'		=>	'bootstrap.min.js',
				'inspinia'		=>	'inspinia.js',
				'metisMenu'		=>	'plugins/metisMenu/jquery.metisMenu.js',
				'slimscroll'	=>	'plugins/slimscroll/jquery.slimscroll.min.js',
				'jquery_datatable'		=>	'plugins/dataTables/jquery.dataTables.js',
				'datatable_bootstrap'	=>	'plugins/dataTables/dataTables.bootstrap.js',
				'datatable_responsive'	=>	'plugins/dataTables/dataTables.responsive.js',
				'datatable_tableTools'	=>	'plugins/dataTables/dataTables.tableTools.min.js',
				'sweetalert'	=>	'plugins/sweetalert/sweetalert.min.js'
			],

			'bootbox-4.4.0'		=>	[
				'bootbox'		=>	'bootbox.min.js'
			],

			'maggicsuggest_2.0'		=>	[
				'maggicsuggest'		=>	'js/maggicsuggest.min.js'
			]
		];
		
		
		Larasset::start('header')
					->storecss($css)
					->css('bootstrap', 'font-awesome', 'ionicons', 'maggicsuggest', 'sweetalert', 'datatable_bootstrap', 'datatable_responsive', 'datatable_tableTools', 'animate', 'style', 'fonts', 'styledcheckbox', 'app');
		Larasset::start()->storejs($js);
		Larasset::start('header')->js('jquery');
		Larasset::start('footer')->js('bootstrap', 'inspinia', 'metisMenu', 'slimscroll', 'maggicsuggest', 'sweetalert', 'bootbox', 'jquery_datatable', 'datatable_bootstrap', 'datatable_responsive', 'datatable_tableTools', 'styledcheckbox', 'validater', 'freset', 'ajaxrequest', 'togglestatus');
		
	}

	public function logout()
	{
		Auth::logout();
	}

}
