<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => ['auth']], function()
{
	Route::get('/', 'PostsController@index');
	Route::get('/home', 'PostsController@index');
	Route::get('/profile', 'ProfileController@index');
	Route::get('/image/upload', 'UploadImageController@index');
	Route::post('image/upload', 'UploadImageController@store');
	Route::post('/home/like', 'PostsController@like');
	Route::post('/home/comment', 'PostsController@comment');
	
});


Auth::routes();

