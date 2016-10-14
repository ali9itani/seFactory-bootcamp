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

Auth::routes();

Route::get('/', function () {
	if(Auth::guest()){
		return view('landing_page');    	
	} else {
		return Redirect::to('home');
	}
});

Route::get('/login', function () {
	if(Auth::guest()){
		return view('login');  	
	} else {
		return Redirect::to('home');
	}
});

Route::group(['middleware' => ['auth']], function()
{
	Route::get('/profile/me/display','ProfileController@index');
	Route::post('/profile/me/edit','ProfileController@store');
	Route::get('/home','HomeController@index');
	Route::get('/post/new','PostController@create');
	Route::post('/post/new','PostController@store');
});


Route::get('/explore', 'ExploreController@random');
Route::get('/explore/top_rated', 'ExploreController@topRated');
Route::get('/explore/trending', 'ExploreController@trending');
Route::get('/explore/most_viewed', 'ExploreController@mostViewed');
