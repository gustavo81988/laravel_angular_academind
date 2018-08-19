<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/quote', ['uses' => 'QuoteController@postQuote']);
Route::get('/quotes', [
    'uses'       => 'QuoteController@getQuotes',
    'middleware' => 'jwt'
]);
Route::put('/quote/{id}', [
    'uses' => 'QuoteController@putQuote',
    'middleware' => 'jwt'
]);
Route::delete('/quote/{id}', [
    'uses' => 'QuoteController@deleteQuote',
    'middleware' => 'jwt'
]);
Route::post('/user', [
    'uses' => 'UserController@signup',
    'middleware' => 'jwt'
]);
Route::post('/user/signin', [
    'uses' => 'UserController@signin',
    'middleware' => 'jwt'
]);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
