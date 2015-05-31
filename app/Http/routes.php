<?php

/**
 * Test Routes
 */
Route::get('/mentions', function (\Gomention\Repositories\Frontend\Mention\MentionContract $mention){


    $mention->textMention(
        '10', //Target User id
        [
            'text' => "Hello, this is a test for text mention using Mention service provider :)" //Mention Data
        ]);


    dd(Auth::user()->mentions()->get()->toArray());

});





/**
 * Frontend Routes
 * Namespaces indicate Controllers folder structure
 */
Route::group(['namespace' => 'Frontend'], function ()
{


    /**
     * Frontend Controllers
     */
    Route::get('/', ['as' => 'home', 'uses' => 'FrontendController@index']);




    /**
     * These frontend controllers require the user to be logged in
     */
    Route::group(['middleware' => 'auth'], function ()
    {
        Route::get('dashboard', ['as' => 'frontend.dashboard', 'uses' => 'DashboardController@index']);
        Route::resource('profile', 'ProfileController', ['only' => ['edit', 'update', 'show']]);
    });




    /**
     * Frontend Access Controllers
     */
    Route::group(['namespace' => 'Auth'], function ()
    {
        Route::group(['middleware' => 'auth'], function ()
        {
            Route::get('auth/logout', 'AuthController@getLogout');
            Route::get('auth/password/change', 'PasswordController@getChangePassword');
            Route::post('auth/password/change', ['as' => 'password.change', 'uses' => 'PasswordController@postChangePassword']);
        });

        Route::group(['middleware' => 'guest'], function ()
        {
            Route::get('auth/login/{provider}', ['as' => 'auth.provider', 'uses' => 'AuthController@loginThirdParty']);
            Route::get('account/confirm/{token}', ['as' => 'account.confirm', 'uses' => 'AuthController@confirmAccount']);
            Route::get('account/confirm/resend/{user_id}', ['as' => 'account.confirm.resend', 'uses' => 'AuthController@resendConfirmationEmail']);

            Route::controller('auth', 'AuthController');
            Route::controller('password', 'PasswordController');
        });
    });




    /**
     * Friendship Controllers
     */
    Route::group(['prefix' => 'friends','middleware' => 'auth'], function () {

        Route::get('/add/{id}', [ 'as' => 'AddFriend', 'uses' => 'FriendshipController@AddFriend']);
        Route::get('/remove/{id}', [ 'as' => 'RemoveFriend', 'uses' => 'FriendshipController@RemoveFriend']);
        Route::get('/accept/{id}', [ 'as' => 'AcceptFriend', 'uses' => 'FriendshipController@AcceptFriend']);
        Route::get('/decline/{id}', [ 'as' => 'DeclineFriend', 'uses' => 'FriendshipController@DeclineFriend']);
        Route::get('/remove_request/{id}', [ 'as' => 'RemoveFriendRequest', 'uses' => 'FriendshipController@RemoveFriendRequest']);
    });
});





/**
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend'], function ()
{
	Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function ()
	{
		/**
		 * These routes need the Administrator Role
		 */
		Route::group([
			'middleware' => 'access.routeNeedsRole',
			'role'       => ['Administrator'],
			'redirect'   => '/',
			'with'       => ['flash_danger', 'You do not have access to do that.']
		], function ()
		{
			Route::get('dashboard', ['as' => 'backend.dashboard', 'uses' => 'DashboardController@index']);
			require_once(__DIR__ . "/Routes/Backend/Access.php");
		});

        Route::get('logs', ['as' => 'Logs', 'uses' => '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index']);

	});
});