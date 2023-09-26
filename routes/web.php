<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
Route::post('/', function () {
    return "heee";
});
Route::group(['prefix' => 'v1'], function () {
    Route::get('/getMessage', 'BotController@getMessage');
    Route::get('/webhook', 'BotController@webhook');
    //  Route::post('sendMessage', 'BotController@sendMessage');
});
