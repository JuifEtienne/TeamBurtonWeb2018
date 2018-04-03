<?php

// Test middleware (TP PASCALE)

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HelloMiddleware
{
    public function handle ($request, Closure $next) {
        if (preg_match( '/gaetan$/i' , $request->getRequestUri())) {
			return response( 'YOU SHALL NOT PASS!' , 403 );
		}
		return $next($request);
    }
}

