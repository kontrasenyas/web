<?php
Route::group(['middleware' => ['web']],function(){

	Route::get('/',function() {
		return view('home');
	})->name('home');

	Route::get('/welcome',function() {
		return view('welcome');
	})->name('welcome');

	Route::post('/signup',[
		'uses'=>'UserController@postSignUp',
		'as'=>'signup'
	]);

	Route::post('/signin',[
		'uses'=>'UserController@postSignIn',
		'as'=>'signin'
	]);

	Route::get('/logout', [
		'uses' => 'UserController@getLogout',
		'as' => 'logout'
	]);

	Route::get('/edit-account', [
		'uses' => 'UserController@getAccountEdit',
		'as' => 'account.edit',
		'middleware' => 'auth'
	]);

	Route::get('/account/{user_id}', [
		'uses' => 'UserController@getAccountProfile',
		'as' => 'account.profile'
	]);

	Route::post('/update-account', [
		'uses' => 'UserController@postSaveAccount',
		'as' => 'account.save',
		'middleware' => 'auth'
	]);

	Route::get('/userimage/{filename}', [
		'uses' => 'UserController@getUserImage',
		'as' => 'account.image'
	]);

	Route::get('/dashboard', [
		'uses' => 'PostController@getDashboard',
		'as' => 'dashboard',
		'middleware' => 'auth'
	]);

	Route::get('/post/{post_id}',[
		'uses'=>'PostController@getPostDetails',
		'as'=>'post.get'
	]);

	Route::post('/createpost',[
		'uses'=>'PostController@postCreatePost',
		'as'=>'post.create',
		'middleware' => 'auth'
	]);

	Route::post('/edit', [
		'uses'=>'PostController@postEditPost',
		'as'=>'edit',
		'middleware' => 'auth'
	]);

	Route::get('/delete-post/{post_id}',[
		'uses'=>'PostController@getDeletePost',
		'as'=>'post.delete',
		'middleware' => 'auth'
	]);

	Route::post('/like', [
		'uses' => 'PostController@postLikePost',
		'as' => 'like'
	]);

	Route::get('/post-image/{filename}', [
		'uses' => 'PostController@getPostImage',
		'as' => 'post.image'
	]);

	Route::post('/post-image', [
		'uses' => 'PostController@postUpdateImage',
		'as' => 'post.image-update',
		'middleware' => 'auth'
	]);

	Route::get('/search', [
		'uses' => 'SearchController@getSearch',
		'as' => 'search'
	]);

	Route::get('/search-location', [
		'uses' => 'SearchController@getSearchLocation',
		'as' => 'search.location'
	]);
	
});