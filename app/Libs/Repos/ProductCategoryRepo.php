<?php namespace App\Libs\Repos;

use App\Models\Productcategory as Model;
use App\Libs\Repos\BaseRepo;

class ProductCategoryRepo extends BaseRepo
{
	public function boot()
	{
		return new Model;
	}

	public function withProducts($id, $mode="retail")
	{
		return $this->model
				->where('id', $id)
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
				}])
				->first();
	}
}