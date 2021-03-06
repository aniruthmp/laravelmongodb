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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('random','CarController@random');
Route::get('cars','CarController@findAll');
Route::get('car/{id}','CarController@findById');
Route::get('car/{id}','CarController@update');
Route::get('year/{year}','CarController@findByYear');
Route::post('cars','CarController@add');

Route::post('rabbit','RabbitController@send');
Route::get('rabbit','RabbitController@recieve');
