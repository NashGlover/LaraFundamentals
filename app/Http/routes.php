<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Authenitcate on a per route basis
Route::get('about', ['middleware' => 'auth', 'uses' => 'PagesController@about']);

Route::get('contact', 'PagesController@contact');

/*Route::get('articles', 'ArticlesController@index');
Route::get('articles/create', 'ArticlesController@create');
// Needs to be last
Route::get('articles/{id}', 'ArticlesController@show');

Route::post('articles', 'ArticlesController@store');
Route::get('articles/{id}/edit', 'ArticlesController@edit');*/

Route::resource('articles', 'ArticlesController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('foo', ['middleware' => 'manager', function()
{
	return 'This page may only be viewed by managers.';
}]);
/*// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');*/


