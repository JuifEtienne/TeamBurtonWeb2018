<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ObjectMiddleware
{
    public function handle ($request, Closure $next) {

    	if ($request->input('name') == NULL) {
        	return response( 'Le champ "name" est manquant' , 403 );
        }

        if ($request->input('idCategory') == NULL) {
        	return response( 'Le champ "idCategory" est manquant' , 403 );
        }

        if (is_int($request->input('idCategory')) == false) {
            return response( 'Le format pour le champ "idCategory" est invalide (format attendu : int)' , 403 );
        }

        return $next($request);
    }
}

