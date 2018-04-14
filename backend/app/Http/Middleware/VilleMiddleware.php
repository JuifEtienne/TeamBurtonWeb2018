<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VilleMiddleware
{
    public function handle ($request, Closure $next) {

    	if ($request->input('nom') == NULL) {
        	return response( 'Le champ "nom" est manquant' , 403 );
        }

        if ($request->input('idPays') == NULL) {
        	return response( 'Le champ "idPays" est manquant' , 403 );
        }

        if ($request->input('idFuseau') == NULL) {
        	return response( 'Le champ "idFuseau" est manquant' , 403 );
        }

        /* Rajouter test pour les valeurs */

        return $next($request);
    }
}
