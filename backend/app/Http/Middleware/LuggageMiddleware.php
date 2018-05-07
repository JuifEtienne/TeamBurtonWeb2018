<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LuggageMiddleware
{
    public function handle ($request, Closure $next) {

    	if ($request->input('name') == NULL) {
        	return response( 'Le champ "name" est manquant' , 403 );
        }
    	if ($request->input('quantity') == NULL) {
        	return response( 'Le champ "quantity" est manquant' , 403 );
        }
    	if ($request->input('idObject') == NULL) {
        	return response( 'Le champ "idObject" est manquant' , 403 );
        }

        return $next($request);
    }
}
