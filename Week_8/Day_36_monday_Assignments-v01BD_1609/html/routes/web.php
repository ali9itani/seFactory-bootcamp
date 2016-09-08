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

//laravel will create all the routes available
Route::resource('posts','PostsController');
Route::resource('post','PostController');
Route::resource('addpost','AddPostController');
Route::resource('login','LoginController');
Route::resource('register','RegisterController');

?>

