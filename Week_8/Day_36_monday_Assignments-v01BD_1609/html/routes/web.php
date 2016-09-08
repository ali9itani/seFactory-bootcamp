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
Route::get('/',function(){
	return redirect('posts');
});
Route::resource('posts','PostsController');
Route::resource('post','PostController');
Auth::routes();
Route::get('/home', 'PostsController@index');
Route::get('/log_in',  function(){
	if (Auth::check()){
		@Auth::logout();
		return redirect('posts');
	} else {
		return redirect('login');
	}

	
});
Route::group(['middleware' => ['auth']], function()
{
	Route::resource('addpost','AddPostController');
});
?>



