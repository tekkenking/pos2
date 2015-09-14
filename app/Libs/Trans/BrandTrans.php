<?php 

namespace App\Libs\Trans;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use App\Models\Brand as Resource;

class BrandTrans extends TransformerAbstract
{
	/**
	* List of resources possible to include
	*
	* @var array
	*/
	protected $availableIncludes = [
		'productcategory'
	];

	/**
	* List of resources to automatically include
	*
	* @var array
	*/
	protected $defaultIncludes = [];

	/**
	* Transform single resource
	*
	* @param \Appkr\Fractal\Example\Resources $resource
	* @return array
	*/
	public function transform(Resource $r)
	{

		return [
			'id'	=>	(int)$r->id,
			'name'	=>	$r->name,
			'published'	=>	(int)$r->published,
			'logo' => $r->brandlogo
		];
	}
}