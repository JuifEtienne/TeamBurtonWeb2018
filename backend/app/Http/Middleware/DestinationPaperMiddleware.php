<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
class DestinationPaperMiddleware

{
    public function handle ($request, Closure $next) {

      if ($request->input('owner') == NULL) {
        	return response( 'Le champ "owner" est manquant' , 403 );
      }
      
        return $next($request);
    }
}