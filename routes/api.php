<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::namespace('Api')
    ->group(function() {

        Route::get('posts', 'PostController@index');
        // rotta show del singlepost
        Route::get('posts/{slug}', 'PostController@show');

        //rotta mail
        Route::post('utentes', 'UtenteController@store');


});
