<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

Route::resource('documentos', 'DocumentoController')->middleware('auth');
Route::resource('seguimientos', 'SeguimientoController')->middleware('auth');
Route::resource('clientes', 'ClienteController')->middleware('auth');

Route::view('/viewpdf', 'viewpdf')->middleware('auth');


