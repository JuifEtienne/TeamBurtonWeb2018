<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DateTime;

class JourneyMiddleware
{
    public function handle ($request, Closure $next) {

    	if ($request->input('name') == NULL) {
        	return response( 'Le champ "name" est manquant' , 403 );
        }

        if ($request->input('startingDate') == NULL) {
        	return response( 'Le champ "startingDate" est manquant' , 403 );
        }

        if ($request->input('endingDate') == NULL) {
        	return response( 'Le champ "endingDate" est manquant' , 403 );
        }

        function validateDate($date, $format = 'Y-m-d') {
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) == $date;
        }

        if (validateDate($request->input('startingDate')) == false) {
            return response( 'Le format pour le champ "startingDate" est invalide (format attendu : yyyy-mm-dd)' , 403 );
        }

        if (validateDate($request->input('endingDate')) == false) {
            return response( 'Le format pour le champ "endingDate" est invalide (format attendu : yyyy-mm-dd)' , 403 );
        }

        return $next($request);
    }
}

