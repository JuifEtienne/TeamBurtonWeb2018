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

$router->group(['prefix' => 'journey'], function($app)
{
	$app->get('/all', 'JourneyController@getAll');	

	$app->get('/{id}', 'JourneyController@getJourney');

	$app->get('/{id}/destinations', 'DestinationController@getAllFromJourney');

	$app->post('/add', [ 'middleware' => 'journey', 'uses' => 'JourneyController@createJourney' ]);

	$app->put('update/{id}', [ 'middleware' => 'journey', 'uses' => 'JourneyController@updateJourney' ]);

	$app->delete('delete/{id}', 'JourneyController@deleteJourney');

});

$router->group(['prefix' => 'destination'], function($app)
{	
	$app->get('/{id}', 'DestinationController@getDestination');

	$app->post('/add', [ 'middleware' => 'destination', 'uses' => 'DestinationController@createDestination' ]);

	$app->put('update/{id}', [ 'middleware' => 'destination', 'uses' => 'DestinationController@updateDestination' ]);
 	 
	$app->delete('delete/{id}', 'DestinationController@deleteDestination');

});

$router->group(['prefix' => 'city'], function($app)
{	
	$app->get('/all', 'CityController@getAll');

	$app->get('/{id}', 'CityController@getCity');

	$app->post('/add', [ 'middleware' => 'city', 'uses' => 'CityController@createCity' ]);

	$app->put('update/{id}', [ 'middleware' => 'city', 'uses' => 'CityController@updateCity' ]);
 	 
	$app->delete('delete/{id}', 'CityController@deleteCity');

});

$router->group(['prefix' => 'country'], function($app)
{	
	$app->get('/all', 'CountryController@getAll');

	$app->get('/{id}', 'CountryController@getCountry');

	$app->get('/{id}/cities', 'CityController@getAllFromCountry');

});

$router->group(['prefix' => 'timezone'], function($app)
{	
	$app->get('/all', 'TimeZoneController@getAll');

	$app->get('/{id}', 'TimeZoneController@getTimeZone');

	$app->get('/{id}/hour', 'TimeZoneController@getLocalHour');

});

$router->group(['prefix' => 'bagage'], function($app)
{
	$app->get('/all', 'BagageController@getAll');

	$app->get('/{id}', 'BagageController@getBagage');

	$app->post('/add', 'BagageController@createBagage');

	$app->put('update/{id}', 'BagageController@updateBagage');

	$app->delete('delete/{id}', 'BagageController@deleteBagage');

});

$router->group(['prefix' => 'objet'], function($app)
{
	$app->get('/all', 'ObjetController@getAll');

	$app->get('/{id}', 'ObjetController@getObjet');

	$app->post('/add', 'ObjetController@createObjet');

	$app->put('update/{id}', 'ObjetController@updateObjet');

	$app->delete('delete/{id}', 'ObjetController@deleteObjet');

});

$router->group(['prefix' => 'monnaie'], function($app)
{
	$app->get('/all', 'MonnaieController@getAll');

	$app->get('/{id}', 'MonnaieController@getMonnaie');

	$app->post('/add', 'MonnaieController@createMonnaie');

	$app->put('update/{id}', 'MonnaieController@updateMonnaie');

	$app->delete('delete/{id}', 'MonnaieController@deleteMonnaie');

});

$router->group(['prefix' => 'word'], function($app)
{
	$app->get('/all', 'WordController@getAll');

	$app->post('/add', [ 'middleware' => 'word', 'uses' => 'WordController@createWord' ]);

	$app->put('update/{id}', [ 'middleware' => 'word', 'uses' => 'WordController@updateWord' ]);

	$app->delete('delete/{id}', 'WordController@deleteWord');

});