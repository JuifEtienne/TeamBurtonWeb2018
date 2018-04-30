<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CityMiddleware
{
    public function handle ($request, Closure $next) {

    	if ($request->input('name') == NULL) {
        	return response( 'Le champ "name" est manquant' , 403 );
        }

        if ($request->input('idCountry') == NULL) {
        	return response( 'Le champ "idCountry" est manquant' , 403 );
        }

        if ($request->input('idTimeZone') == NULL) {
        	return response( 'Le champ "idTimeZone" est manquant' , 403 );
        }

        if (is_int($request->input('idCountry')) == false) {
            return response( 'Le format pour le champ "idCountry" est invalide (format attendu : int)' , 403 );
        }

        if (is_int($request->input('idTimeZone')) == false) {
            return response( 'Le format pour le champ "idTimeZone" est invalide (format attendu : int)' , 403 );
        }

        return $next($request);
    }
}

