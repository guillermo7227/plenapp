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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'namespace' => 'API',
    'as' => 'api.'
], function() {
    Route::group([
        'prefix' => 'medios',
        'as' => 'medios.'
    ] , function() {
        Route::get('{medio}', 'MedioController@show')->name('show');
    });

    Route::group([
        'prefix' => 'seguimientos',
        'as' => 'seguimientos.'
    ] , function() {
        Route::get('{seguimiento}', 'SeguimientoController@show')->name('show');
        Route::put('{seguimiento}', 'SeguimientoController@update')->name('update');
    });
});
