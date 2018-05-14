
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
    return 'Welcome to the Journeo API !';
});

$router->group(['prefix' => 'journey'], function($app)
{
	$app->get('/all', 'JourneyController@getAll');

	$app->get('/{id}', 'JourneyController@getJourney');

	$app->post('/add', [ 'middleware' => 'journey', 'uses' => 'JourneyController@createJourney' ]);

	$app->put('{id/}/update', [ 'middleware' => 'journey', 'uses' => 'JourneyController@updateJourney' ]);

	$app->delete('{id}/delete', 'JourneyController@deleteJourney');

  	/* Destinations */
  	$app->get('/{id}/destinations', 'DestinationController@getAllFromJourney');
});

$router->group(['prefix' => 'destination'], function($app)
{
	$app->get('/{id}', 'DestinationController@getDestination');

	$app->post('/add', [ 'middleware' => 'destination', 'uses' => 'DestinationController@createDestination' ]);

	$app->put('{id}/update', [ 'middleware' => 'destination', 'uses' => 'DestinationController@updateDestination' ]);

	$app->delete('{id}/delete', 'DestinationController@deleteDestination');

	// Papers
	
	$app->get('/{idDestination}/papers', 'PaperController@getAllFromDestination');

	$app->post('/{idDestination}/paper/{idPaper}/add', ['middleware' => 'destinationPaper', 'uses' => 'PaperController@addPaperToDestination']);

    $app->put('/{idDestination}/paper/{idPaper}/update', ['middleware' => 'destinationPaper', 'uses' => 'PaperController@updatePaperFromDestination']);
	
 	$app->delete('/{idDestination}/paper/{idPaper}/delete', ['middleware' => 'destinationPaper', 'uses' => 'PaperController@deletePaperFromDestination']);

 	// Activities

 	$app->get('/{idDestination}/activities', 'ActivityController@getAllFromDestination');

	$app->post('/{idDestination}/activity/{idActivity}/add', 'ActivityController@addActivityToDestination');

 	$app->delete('/{idDestination}/activity/{idActivity}/delete', 'ActivityController@deleteActivityFromDestination');

 	$app->get('/{idDestination}/activities/sum', 'ActivityController@getPriceSumFromDestination');

});

$router->group(['prefix' => 'city'], function($app)
{
	$app->get('/all', 'CityController@getAll');

	$app->get('/{id}', 'CityController@getCity');

	$app->post('/add', [ 'middleware' => 'city', 'uses' => 'CityController@createCity' ]);

	$app->put('{id}/update', [ 'middleware' => 'city', 'uses' => 'CityController@updateCity' ]);

	$app->delete('{id}/delete', 'CityController@deleteCity');
});

$router->group(['prefix' => 'country'], function($app)
{
	$app->get('/all', 'CountryController@getAll');

	$app->get('/{id}', 'CountryController@getCountry');

  /* Cities */
	$app->get('/{id}/cities', 'CityController@getAllFromCountry');

  /* Currency */
  $app->get('/{idCountry}/currency', 'CurrencyController@getCurrencyFromCountry');

});

$router->group(['prefix' => 'timezone'], function($app)
{
	$app->get('/all', 'TimeZoneController@getAll');

	$app->get('/{id}', 'TimeZoneController@getTimeZone');

	$app->get('/{id}/hour', 'TimeZoneController@getLocalHour');

});

$router->group(['prefix' => 'currency'], function($app)
{
	$app->get('/all', 'CurrencyController@getAll');

	$app->get('/{idCurrency}', 'CurrencyController@getCurrency');

	$app->post('/add', 'CurrencyController@createCurrency');

	$app->put('/{idCurrency}/update', 'CurrencyController@updateCurrency');

	$app->delete('/{idCurrency}/delete', 'CurrencyController@deleteCurrency');
});

$router->group(['prefix' => 'luggage'], function($app)
{
	$app->get('/all', 'LuggageController@getAll');

	$app->get('/{idLuggage}', 'LuggageController@getLuggage');

	$app->post('/add', [ 'middleware' => 'luggage', 'uses' => 'LuggageController@createLuggage' ]);

	$app->put('/{idLuggage}/update', [ 'middleware' => 'luggage', 'uses' => 'LuggageController@updateLuggage' ]);

	$app->delete('/{idLuggage}/delete', 'LuggageController@deleteLuggage');

	/* Objects */

	$app->get('/{idLuggage}/content', 'LuggageController@getAllObjectsFromLuggage');

 	$app->post('/{idLuggage}/object/{idObject}/add', ['middleware' => 'luggageObject', 'uses' => 'LuggageController@addObjectToLuggage']);

	$app->put('/{idLuggage}/object/{idObject}/update', 'LuggageController@updateObjectFromLuggage');

	$app->put('/{idLuggage}/object/{idObject}/present', 'LuggageController@objectIsPresentInLuggage');

 	$app->delete('/{idLuggage}/object/{idObject}/delete', 'LuggageController@deleteObjectFromLuggage');

 	$app->get('/{idLuggage}/object/idMax', 'LuggageController@getIdObjectMaxFromLuggage');
});

$router->group(['prefix' => 'object'], function($app)
{
	$app->get('/all', 'ObjectController@getAll');

	$app->post('/add', [ 'middleware' => 'object', 'uses' => 'ObjectController@createObject' ]);

	$app->put('{id}/update', [ 'middleware' => 'object', 'uses' => 'ObjectController@updateObject' ]);
});

$router->group(['prefix' => 'paper'], function($app)
{
	$app->get('/all', 'PaperController@getAll');

	$app->get('/{idPaper}', 'PaperController@getPaper');

	$app->post('/add', [ 'middleware' => 'paper', 'uses' => 'PaperController@createPaper' ]);

	$app->put('{idPaper}/update', [ 'middleware' => 'paper', 'uses' => 'PaperController@updatePaper' ]);
});

$router->group(['prefix' => 'word'], function($app)
{
	$app->get('/all', 'WordController@getAll');

	$app->post('/add', [ 'middleware' => 'word', 'uses' => 'WordController@createWord' ]);

	$app->put('{id}/update', [ 'middleware' => 'word', 'uses' => 'WordController@updateWord' ]);
	
	$app->delete('{id}/delete', 'WordController@deleteWord');
});
