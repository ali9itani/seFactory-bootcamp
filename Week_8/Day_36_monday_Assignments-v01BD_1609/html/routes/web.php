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
Route::get('posts','PostsController@index');
Route::get('/home', 'PostsController@index');

Route::group(['middleware' => ['auth']], function()
{
	Route::get('post/add','PostController@create');
	Route::post('post','PostController@store');
	Route::get('posts/my-posts','PostsController@myPosts');
});
Route::get('post/{id}','PostController@show');
Route::delete('post/{post_id}','PostController@destroy');
Route::get('post','PostsController@index');

Auth::routes();
Route::get('/log_in',  function(){
	if (Auth::check()){
		@Auth::logout();
		return redirect('posts');
	} else {
		return redirect('login');
	}	
});

?>



