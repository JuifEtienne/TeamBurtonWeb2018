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

$router->group(['prefix' => 'bagages'], function($app)
{
	$app->get('/','BagageController@getAll');

	$app->get('/{id}','BagageController@getBagage');

	$app->post('/add','BagageController@createBagage');

	$app->put('update/{id}','BagageController@updateBagage');

	$app->delete('delete/{id}','BagageController@deleteBagage');

});

$router->group(['prefix' => 'objets'], function($app)
{
	$app->get('/','ObjetController@getAll');

	$app->get('/{id}','ObjetController@getObjet');

	$app->post('/add','ObjetController@createObjet');

	$app->put('update/{id}','ObjetController@updateObjet');

	$app->delete('delete/{id}','ObjetController@deleteObjet');

});

$router->group(['prefix' => 'monnaies'], function($app)
{
	$app->get('/','MonnaieController@getAll');

	$app->get('/{id}','MonnaieController@getMonnaie');

	$app->post('/add','MonnaieController@createMonnaie');

	$app->put('update/{id}','MonnaieController@updateMonnaie');

	$app->delete('delete/{id}','MonnaieController@deleteMonnaie');

});
