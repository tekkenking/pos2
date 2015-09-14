<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Basemodel
{
	use SoftDeletes;

	public static function boot(){
		parent::boot();

		//This event will delete all related model in category model
		static::deleted(function($brand){
			$r = $brand->productcategories()->lists('id');
			if( !empty($r) ){ Productcategory::destroy($r); }
		});
	}

	public function productcategories()
	{
		return $this->hasMany( Productcategory::class );
	}

	public function getIdAttribute($value)
	{
		return (int)$value;
	}

	public function getPublishedAttribute($value)
	{
		return (int)$value;
	}
}
