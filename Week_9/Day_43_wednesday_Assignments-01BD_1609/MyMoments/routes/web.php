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
    return view('display_profile');
});
Route::get('/image/upload', 'UploadImageController@index');
Route::post('image/upload', 'UploadImageController@store');

Auth::routes();

Route::get('/home', function () {
    return view('display_profile');
});