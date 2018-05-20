<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DateTime;
// 'id', 'name', 'price', 'date'
class ActivityMiddleware
{
    public function handle ($request, Closure $next) {

        if ($request->input('name') == NULL) {
        	return response( 'Le champ "name" est manquant' , 403 );
        }

        if ($request->input('date') == NULL) {
        	return response( 'Le champ "date" est manquant' , 403 );
        }

        if ($request->input('price') == NULL) {
            return response( 'Le champ "price" est manquant' , 403 );
        }

        function validateDate($date, $format = 'Y-m-d') {
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) == $date;
        }

        if (validateDate($request->input('date')) == false) {
            return response( 'Le format pour le champ "date" est invalide (format attendu : yyyy-mm-dd)' , 403 );
        }

        if (is_numeric($request->input('price')) == false) {
            return response( 'Le format pour le champ "price" est invalide (format attendu : nombre)' , 403 );
        }

        return $next($request);
    }
}

