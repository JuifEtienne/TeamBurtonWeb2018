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

$router->group(['prefix' => 'voyages'], function($app)
{
	$app->get('/','VoyageController@getAll');
	
	$app->get('/{id}','VoyageController@getVoyage');

	$app->post('/add','VoyageController@createVoyage');

	$app->put('update/{id}','VoyageController@updateVoyage');
 	 
	$app->delete('delete/{id}','VoyageController@deleteVoyage');

});