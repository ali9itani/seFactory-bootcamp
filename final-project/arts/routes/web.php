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

Route::get('/register', function () {
	return view('landing_page');  	
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
	Route::get('/me','ProfileController@displayMyProfile');
	Route::get('/me/edit','EditProfileController@index');
	Route::post('/me/edit','EditProfileController@store');
	Route::get('/home','HomeController@index');
	Route::get('/post/new','PostController@create');
	Route::post('/post/new','PostController@store');
	Route::post('/artist/{username}','ProfileController@follow');
	Route::get('/post/{post_id}','PostDisplayController@display');
	Route::post('/post/like','PostDisplayController@like');
	Route::post('/post/comment','PostDisplayController@comment');
	Route::post('/post/vote','PostDisplayController@vote');
});


Route::get('/explore', 'ExploreController@random');
Route::get('/explore/views', 'ExploreController@byViews');
Route::get('/explore/artists', 'ExploreController@byartists');
Route::get('/artist/{username}', 'ProfileController@artistProfile');

