<?php namespace App\Libs\Repos;

use App\Models\Brand as Model;
use App\Libs\Repos\BaseRepo;

class BrandRepo extends BaseRepo
{
	public function boot()
	{
		return new Model;
	}

	public function allWithCategories()
	{
		return $this->model
				->with(['productcategories' => function($qr){
					return $qr->select('id', 'brand_id', 'name', 'type', 'published');
				}])
				->select('id', 'name', 'published', 'brandlogo')
				->get();
	}

	public function byBrandIdWithCat($id)
	{
		return $this->model->where('id', $id)
				->with(['productcategories' => function($qr){
					return $qr->with(['products'=>function($pr){
						return $pr->select('id', 'productcat_id', 'name');
					}])->select('id', 'brand_id', 'name', 'type');
				}])->first();
	}

	public function withCategoryAndProducts($id, $catid, $mode="retail")
	{
		return $this->model
				->where('id', $id)
				->with(['productcategories' => function($q)use($catid){
					return $q->where('id', $catid)
							->with(['products' => function($qr) use ($mode){
								return $qr->select(			
									'id',
									'productcat_id',
									'brand_id',
									'barcodeid',
									'name',
									'quantity',
									'almost_finished',
									'costprice',
									'published',
									$mode.'_price as price',
									$mode.'_discount as discount',
									$mode.'_discountedprice as discountedprice',
									$mode.'_totalprice as totalprice'
								);
				}]);
				}])
				->first();
	}

}