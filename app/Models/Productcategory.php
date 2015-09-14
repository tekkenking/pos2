<?php

namespace App\Models;

class Productcategory extends Basemodel
{

	public static function boot(){
		parent::boot();

		//This event will delete all related model in category model
		static::deleted(function($productcat){
			$r = $productcat->products()->lists('id');
			if( !empty($r) ){ Product::destroy($r); }
		});
	}

	public function brand()
	{
		return $this->belongsTo( Brand::class );
	}

	public function products()
	{
		return $this->hasMany(Product::class, 'productcat_id');
	}

	public function getIdAttribute($value)
	{
		return (int)$value;
	}

	public function getBrandIdAttribute($value)
	{
		return (int)$value;
	}

	public function getPublishedAttribute($value)
	{
		return (int)$value;
	}

}
