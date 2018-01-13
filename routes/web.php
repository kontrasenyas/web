<?php
Route::group(['middleware' => ['web']],function(){

	//facebook socialite
	Route::get('login/facebook', [
		'uses' => 'UserController@redirectToProvider',
		'as' => 'login.facebook'
	]);
	Route::get('login/facebook/callback', [
		'uses' => 'UserController@handleProviderCallback',
	]);

	Route::get('/', [
		'uses' => 'HomeController@getHome',
		'as' => 'home'
	]);
	Route::get('/about', [
	    'uses' => 'HomeController@getAbout',
        'as' => 'about'
    ]);
	Route::get('/contact_us', [
	   'uses' => 'HomeController@getContact',
        'as' => 'contact'
    ]);
    Route::get('/help', [
        'uses' => 'HomeController@getHelp',
        'as' => 'help'
    ]);
    Route::get('/terms', [
        'uses' => 'HomeController@getTerms',
        'as' => 'terms'
    ]);

    Route::get('/messages/{user_id}', [
    	'uses' => 'MessageController@index',
    	'as' => 'messages',
    	'middleware' => 'auth'
    ]);
    Route::get('ajax/messages/{user_id}/{requested_by}', [
    	'uses' => 'MessageController@getIndex',
    	'as' => 'ajax.messages',
    	'middleware' => 'auth'
    ]);
    Route::post('/message/{sent_to}', [
    	'uses' => 'MessageController@postMessage',
    	'as' => 'post.message',
    	'middleware' => 'auth'
    ]);
    Route::get('/message/u/{user_id}',[
    	'uses' => 'MessageController@getMessage',
    	'as' => 'get.message',
    	'middleware' => 'auth'
    ]);
    Route::get('/message/u/{user_id}/?post={post_id}',[
    	'uses' => 'MessageController@getMessage',
    	'as' => 'get.message-post',
    	'middleware' => 'auth'
    ]);
    Route::get('/message_count/{user_id}', [
    	'uses' => 'MessageController@getCountMessage',
    	'as' => 'count.message',
    	'middleware' => 'auth'
    ]);

    Route::post('/moment', [
       'uses' => 'MomentController@postMoment',
        'as' => 'moment.create',
        'middleware' => 'auth'
    ]);
    Route::get('/moments/{user_id}', [
       'uses' => 'MomentController@getMoments',
        'as' => 'moments.user'
    ]);
    Route::get('/moment/{filename}', [
       'uses' => 'MomentController@getMomentImage',
        'as' => 'moment.image'
    ]);

	Route::get('/login', function() {
	    if (Auth::check()) {return Redirect::to('/');}
		return view('accounts.login');
	})->name('login');

	Route::get('/register', function() {
        if (Auth::check()) {return Redirect::to('/');}
		return view('accounts.register');
	})->name('register');

	Route::get('/register/ajax/get-email/{email}', [
		'uses' => 'UserController@getEmail',
		'as' => 'ajax.get-email'
	]);
	Route::get('/register/ajax/get-mobileno/{mobileno}', [
		'uses' => 'UserController@getMobileNo',
		'as' => 'ajax.get-mobileno'
	]);

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
	Route::post('/update-mobile', [
		'uses' => 'UserController@postSaveMobile',
		'as' => 'account.save-mobile',
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
		'as' => 'account.forgot',
        'middleware' => 'guest'
	]);

	Route::get('/forgot-password-sms', [
	   'uses' => 'UserController@getForgotPasswordSMS',
        'as' => 'account.forgot-sms',
        'middleware' => 'guest'
    ]);

	Route::get('/reset-password/{token}/{code}', [
		'uses' => 'UserController@getResetPassword',
		'as' => 'account.get-reset-password'
	]);

	Route::get('/reset-password-error',function() {
		return view('accounts.reset-password-error');
	})->name('reset-password-error');

	Route::post('/reset-password', [
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
	Route::post('/userimage', [
		'uses' => 'UserController@postUserImage',
		'as' => 'account.post-image'
	]);

	Route::get('/review/{user_id}', [
		'uses' => 'UserController@getReview',
		'as' => 'account.review'
	]);
	Route::post('/review', [
		'uses' => 'UserController@postReview',
		'as' => 'account.review-post',
        'middleware' => 'auth'
	]);

	Route::get('/dashboard', [
		'uses' => 'HomeController@getDashboard',
		'as' => 'dashboard',
		'middleware' => 'auth'
	]);

	Route::get('/user-post/{user_id}', [
	   'uses' => 'PostController@getUserPost',
        'as' => 'user-post'
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

	Route::get('/post-image-delete/{filename}', [
		'uses' => 'PostController@deletePostImage',
		'as' => 'post.image-delete'
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

	Route::get('/search-index', [
		'uses' => 'SearchController@index',
		'as' => 'search-index'
	]);

	Route::get('/search-location', [
		'uses' => 'SearchController@getSearchLocation',
		'as' => 'search.location'
	]);	
	
});