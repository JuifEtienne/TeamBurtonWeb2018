<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DateTime;

class VoyageMiddleware
{
    public function handle ($request, Closure $next) {

    	if ($request->input('nom') == NULL) {
        	return response( 'Le champ "nom" est manquant' , 403 );
        }

        if ($request->input('dateDebut') == NULL) {
        	return response( 'Le champ "dateDebut" est manquant' , 403 );
        }

        if ($request->input('dateFin') == NULL) {
        	return response( 'Le champ "dateFin" est manquant' , 403 );
        }

        function validateDate($date, $format = 'Y-m-d') {
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) == $date;
        }

        if (validateDate($request->input('dateDebut')) == false) {
            return response( 'Le format pour le champ "dateDebut" est invalide (format attendu : yyyy-mm-dd)' , 403 );
        }

        if (validateDate($request->input('dateFin')) == false) {
            return response( 'Le format pour le champ "dateFin" est invalide (format attendu : yyyy-mm-dd)' , 403 );
        }

        return $next($request);
    }
}

