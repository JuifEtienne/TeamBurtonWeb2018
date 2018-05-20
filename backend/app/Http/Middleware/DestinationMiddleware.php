<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DateTime;

class DestinationMiddleware
{
    public function handle ($request, Closure $next) {

        if ($request->input('arrivalDate') == NULL) {
        	return response( 'Le champ "arrivalDate" est manquant' , 403 );
        }

        if ($request->input('departureDate') == NULL) {
        	return response( 'Le champ "departureDate" est manquant' , 403 );
        }

        if ($request->input('idJourney') == NULL) {
            return response( 'Le champ "idJourney" est manquant' , 403 );
        }

        if ($request->input('idCity') == NULL) {
            return response( 'Le champ "idCity" est manquant' , 403 );
        }

        function validateDate($date, $format = 'Y-m-d') {
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) == $date;
        }

        if (validateDate($request->input('arrivalDate')) == false) {
            return response( 'Le format pour le champ "arrivalDate" est invalide (format attendu : yyyy-mm-dd)' , 403 );
        }

        if (validateDate($request->input('departureDate')) == false) {
            return response( 'Le format pour le champ "departureDate" est invalide (format attendu : yyyy-mm-dd)' , 403 );
        }

        if (is_int($request->input('idJourney')) == false) {
            return response( 'Le format pour le champ "idJourney" est invalide (format attendu : int)' , 403 );
        }

        if (is_int($request->input('idCity')) == false) {
            return response( 'Le format pour le champ "idCity" est invalide (format attendu : int)' , 403 );
        }

        return $next($request);
    }
}

