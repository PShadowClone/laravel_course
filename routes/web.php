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

use Kreait\Firebase;

Auth::routes();
Route::get('store', ['as' => 'library.store', 'uses' => 'library\LibraryController@store']);


/**
 *
 * Book's routes
 *
 */


Route::group([], function () {
    Route::get('test', function () {
        return \Illuminate\Support\Facades\Auth::user();
    });
    Route::get('/home', 'HomeController@index')->name('admin.home');

    Route::group(['prefix' => 'book'], function () {
        Route::get('create', 'BookController@create');
        Route::post('create', ['as' => 'book.create', 'uses' => 'BookController@store']);
        Route::get('/all', ['as' => 'book.index', 'uses' => 'BookController@index']);
        Route::get('destroy/{id}', ['as' => 'book.destroy', 'uses' => 'BookController@destroy']);
        Route::get('edit/{id}', ['as' => 'book.edit', 'uses' => 'BookController@edit']);
        Route::put('update/{id}', ['as' => 'book.update', 'uses' => 'BookController@update']);

    });

    /**
     *
     * Category's route
     *
     */
    Route::group(['prefix' => 'category'], function () {
        Route::get('/create', ['as' => 'category.create', 'uses' => 'CategoryController@create']);
        Route::post('/store', ['as' => 'category.store', 'uses' => 'CategoryController@store']);
        Route::get('/', ['as' => 'category.index', 'uses' => 'CategoryController@index']);
        Route::get('/delete/{id?}', ['as' => 'category.destroy', 'uses' => 'CategoryController@destroy']);
        Route::get('/edit/{id?}', ['as' => 'category.edit', 'uses' => 'CategoryController@edit']);
        Route::put('/update/{id}', ['as' => 'category.update', 'uses' => 'CategoryController@update']);
        Route::get('/ajax/check/delete/{id}', ['as' => 'ajax.category.check.destroy', 'uses' => 'CategoryController@checkCategoryBooks']);
    });

    Route::group(['prefix' => 'library', 'namespace' => 'library'], function () {
        Route::get('create', ['as' => 'library.create', 'uses' => 'LibraryController@create']);
        Route::get('email', ['as' => 'library.email', 'uses' => 'LibraryController@sendEmail']);
        Route::post('ajax/check', ['as' => 'ajax.library.check', 'uses' => 'LibraryController@check']);
    });


//    Route::get('/language/{lang?}', [
//        'as' => 'language.change',
//        'uses' => 'LocalizationController@change'
//    ]);

    Route::get('language/{lang?}', ['as' => 'language.change', 'uses' => 'LocalizationController@change']);
    Route::get('/logout/custom', ['as' => 'logout.custom', 'uses' => 'Controller@userLogout']);

});

Route::group(['middleware' => 'App\Http\Middleware\HomeAuth'], function () {
    Route::resource('user', 'NewUSerController');
    Route::get('/home', 'HomeController@index')->name('library.home');
    Route::get('library/test', function () {
        return view('base_layout._layout');
    });

});


Route::get('firebase/save', 'FirebaseController@store');
Route::get('firebase/show', 'FirebaseController@index');
Route::get('firebase/update', 'FirebaseController@update');


