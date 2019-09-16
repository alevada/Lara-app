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



//Route::get('/', function () { return view('welcome');});

// routes for login
Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

// custom routes
Route::get('/', 'HomeController@getAuth');
Route::get('/home', 'HomeController@getIndex')->name('home');
Route::get('/search', 'HomeController@getSearchResult');


Route::resource('user', 'UserController');
Route::resource('post', 'PostController');

Route::get('/post/{id}/delete', 'PostController@fakeDestroy' )->name('fakeDestroy'); // hack, no time to make delete works


//Route::controller('user', 'UserController');