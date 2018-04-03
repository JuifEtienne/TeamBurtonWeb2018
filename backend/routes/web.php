<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Exemple requête GET (TP PASCALE)
$router->get( '/hello/world' , function () {
	return "Hello World" ;
});

// Exemple GET avec paramètre et middleware (TP PASCALE) 
$router->get( '/hello/{name}' , [ 'middleware' => 'hello' , function ($name) {
	return "Hello {$name}" ;
}]);

$router->group(['prefix' => 'voyage'], function($app)
{
	/*$app->post('voyage','VoyageController@createVoyage');

	$app->put('voyage/{id}','VoyageController@updateVoyage');
 	 
	$app->delete('voyage/{id}','VoyageController@deleteVoyage');*/

	$app->get('/','VoyageController@index');
});