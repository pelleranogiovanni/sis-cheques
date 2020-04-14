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

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
    Route::resource('providers', 'ProvidersController');

    // Route::resource('checks', 'ChecksController');
    Route::get('checks-alta/{id}', ['as' => 'checks.create', 'uses' => 'ChecksController@create']);
    Route::get('checks', ['as' => 'checks.index', 'uses' => 'ChecksController@index']);
    Route::post('checks', ['as' => 'checks.store', 'uses' => 'ChecksController@store']);
});

// Route::resource('providers', 'ProvidersController');
