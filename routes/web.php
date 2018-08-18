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


Route::group(['prefix' => 'book'], function () {
    Route::get('create', 'BookController@create');
    Route::post('create', ['as' => 'book.store']);
    Route::get('all', ['as' => 'book.index', 'uses' => 'BookController@index']);
    Route::get('destroy/{id}', ['as' => 'book.destroy', 'uses' => 'BookController@destroy']);
});
