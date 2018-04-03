<?php

// Test middleware (TP PASCALE)

namespace App\Http\Middleware;

use Closure;

class OldMiddleware
{
    public function handle ($request, Closure $next) {
        if ($request->input( 'age' ) > 200 ) {
            return redirect( '/hello/world' );
        }
        return $next($request);
    }
}

