<?php

namespace App\Models;

class Product extends Basemodel
{
	public function productcategory()
	{
		return $this->belongsTo( Productcategory::class, 'productcat_id' );
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
