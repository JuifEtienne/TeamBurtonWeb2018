<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class WordMiddleware
{
    public function handle ($request, Closure $next) {

    	if ($request->input('word') == NULL) {
        	return response( 'Le champ "word" est manquant' , 403 );
        }

        return $next($request);
    }
}

