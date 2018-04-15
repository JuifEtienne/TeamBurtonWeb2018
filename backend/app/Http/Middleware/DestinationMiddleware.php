<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DateTime;

class DestinationMiddleware
{
    public function handle ($request, Closure $next) {

        if ($request->input('dateArrivee') == NULL) {
        	return response( 'Le champ "dateArrivee" est manquant' , 403 );
        }

        if ($request->input('dateDepart') == NULL) {
        	return response( 'Le champ "dateDepart" est manquant' , 403 );
        }

        if ($request->input('idVoyage') == NULL) {
            return response( 'Le champ "idVoyage" est manquant' , 403 );
        }

        if ($request->input('idVille') == NULL) {
            return response( 'Le champ "idVille" est manquant' , 403 );
        }

        function validateDate($date, $format = 'Y-m-d') {
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) == $date;
        }

        if (validateDate($request->input('dateArrivee')) == false) {
            return response( 'Le format pour le champ "dateArrivee" est invalide (format attendu : yyyy-mm-dd)' , 403 );
        }

        if (validateDate($request->input('dateDepart')) == false) {
            return response( 'Le format pour le champ "dateDepart" est invalide (format attendu : yyyy-mm-dd)' , 403 );
        }

        if (is_int($request->input('idVoyage')) == false) {
            return response( 'Le format pour le champ "idVoyage" est invalide (format attendu : int)' , 403 );
        }

        if (is_int($request->input('idVille')) == false) {
            return response( 'Le format pour le champ "idVille" est invalide (format attendu : int)' , 403 );
        }

        return $next($request);
    }
}

