<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('datatables', 'DatatablesController@index')->name('datatables');
Route::get('datatables/data', 'DatatablesController@getData')->name('datatables.data');


// Route::post('datatables/custom', 'DatatablesController@getCustomFilterData')->name('datatables.custom');
