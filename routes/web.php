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

Route::get('/', 'ExampleController@index')->name('home');
Route::get('/examples/create', 'ExampleController@create');
Route::get('/examples/download', 'ExampleController@download');
Route::get('/examples/{example}/edit', 'ExampleController@edit');
Route::put('/examples/{example}', 'ExampleController@update');
Route::post('/examples', 'ExampleController@store');
Route::delete('/examples/{example}', 'ExampleController@delete');
