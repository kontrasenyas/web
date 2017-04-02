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

	Route::get('/change-password', [
		'uses' => 'UserController@getChangePassword',
		'as' => 'account.get-change-password',
		'middleware' => 'auth'
	]);

	Route::post('/change-password', [
		'uses' => 'UserController@postChangePassword',
		'as' => 'account.post-change-password',
		'middleware' => 'auth'
	]);

	Route::get('/forgot-password', [
		'uses' => 'UserController@getForgotPassword',
		'as' => 'account.forgot'
	]);

	Route::get('/reset-password/{token}/{code}', [
		'uses' => 'UserController@getResetPassword',
		'as' => 'account.get-reset-password'
	]);

	ROute::post('/reset-password', [
		'uses' => 'UserController@postResetPassword',
		'as' => 'account.post-reset-password'
	]);

	Route::post('/send-sms', [
		'uses' => 'UserController@postSendSMS',
		'as' => 'account.send-sms'
	]);

	Route::post('/send-email-forgot', [
		'uses' => 'UserController@postSendEmailForgotPassword',
		'as' => 'account.send-email-forgot'
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