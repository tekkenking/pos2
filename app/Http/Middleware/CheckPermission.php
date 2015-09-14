<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {	
	
		if( ! $this->hasPermission() ){
		
			return response()->json(['url'=>'404'], 422);
		}
			return $next($request);
    }
	
	private function hasPermission()
	{
		return false;
	}
}
