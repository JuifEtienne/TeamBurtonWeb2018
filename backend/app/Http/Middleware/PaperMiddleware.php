<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PaperMiddleware
{
    public function handle ($request, Closure $next) {

        if ($request->input('name') == NULL) {
            return response( 'Le champ "name" est manquant' , 403 );
        }

        if ($request->input('note') == NULL) {
            return response( 'Le champ "note" est manquant' , 403 );
        }

        return $next($request);
    }
}

