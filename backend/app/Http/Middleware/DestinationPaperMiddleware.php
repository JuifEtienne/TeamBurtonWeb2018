<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DestinationPaperMiddleware
{
    public function handle ($request, Closure $next) {

      if ($request->input('idPaper') == NULL) {
        return response( 'Le champ "idPaper" est manquant' , 403 );
      }
      if (is_int($request->input('idPaper')) == false) {
          return response( 'Le format pour le champ "idPaper" est invalide (format attendu : int)' , 403 );
      }
      if ($request->input('owner') == NULL) {
        	return response( 'Le champ "owner" est manquant' , 403 );
      }

        return $next($request);
    }
}
