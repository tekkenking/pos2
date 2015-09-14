<?php

namespace App\Models;

class Useractivity extends Basemodel
{
    protected $table = 'users_activities';

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
