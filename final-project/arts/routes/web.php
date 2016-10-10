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

Route::get('/', function () {
	if(Auth::guest()){
    	return view('landing_page');    	
	} else {
    	return Redirect::to('home');
	}
});

Auth::routes();

Route::get('/explore', function () {
    return view('explore');
});
Route::get('/home', function () {
    return view('home');
});