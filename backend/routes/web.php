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

$router->group(['prefix' => 'voyage'], function($app)
{
	$app->get('/all', 'VoyageController@getAll');	

	$app->get('/{id}', 'VoyageController@getVoyage');

	$app->get('/{id}/destinations', 'DestinationController@getAllFromVoyage');

	$app->post('/add', [ 'middleware' => 'voyage', 'uses' => 'VoyageController@createVoyage' ]);

	$app->put('update/{id}', [ 'middleware' => 'voyage', 'uses' => 'VoyageController@updateVoyage' ]);

	$app->delete('delete/{id}', 'VoyageController@deleteVoyage');

});

$router->group(['prefix' => 'destination'], function($app)
{	
	$app->get('/{id}', 'DestinationController@getDestination');

	$app->post('/add', [ 'middleware' => 'destination', 'uses' => 'DestinationController@createDestination' ]);

	$app->put('update/{id}', [ 'middleware' => 'destination', 'uses' => 'DestinationController@updateDestination' ]);
 	 
	$app->delete('delete/{id}', 'DestinationController@deleteDestination');

});

$router->group(['prefix' => 'ville'], function($app)
{	
	$app->get('/all', 'VilleController@getAll');

	$app->get('/{id}', 'VilleController@getVille');

	$app->post('/add', [ 'middleware' => 'ville', 'uses' => 'VilleController@createVille' ]);

	$app->put('update/{id}', [ 'middleware' => 'ville', 'uses' => 'VilleController@updateVille' ]);
 	 
	$app->delete('delete/{id}', 'VilleController@deleteVille');

});

$router->group(['prefix' => 'pays'], function($app)
{	
	$app->get('/{id}/villes', 'VilleController@getAllFromPays');

});

$router->group(['prefix' => 'bagages'], function($app)
{
	$app->get('/', 'BagageController@getAll');

	$app->get('/{id}', 'BagageController@getBagage');

	$app->post('/add', 'BagageController@createBagage');

	$app->put('update/{id}', 'BagageController@updateBagage');

	$app->delete('delete/{id}', 'BagageController@deleteBagage');

});

$router->group(['prefix' => 'objets'], function($app)
{
	$app->get('/', 'ObjetController@getAll');

	$app->get('/{id}', 'ObjetController@getObjet');

	$app->post('/add', 'ObjetController@createObjet');

	$app->put('update/{id}', 'ObjetController@updateObjet');

	$app->delete('delete/{id}', 'ObjetController@deleteObjet');

});

$router->group(['prefix' => 'monnaies'], function($app)
{
	$app->get('/', 'MonnaieController@getAll');

	$app->get('/{id}', 'MonnaieController@getMonnaie');

	$app->post('/add', 'MonnaieController@createMonnaie');

	$app->put('update/{id}', 'MonnaieController@updateMonnaie');

	$app->delete('delete/{id}', 'MonnaieController@deleteMonnaie');

});
