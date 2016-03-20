<?php

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

        Route::get('/mentions/{id}', ['as' => 'mentions.by', 'where' => ['id' => '[0-9]+'], 'uses' => 'FrontendController@mentions']);

        Route::get('dashboard', ['as' => 'frontend.dashboard', 'uses' => 'DashboardController@index']);

        Route::get('profile/{id}', ['as' => 'profile.show', 'where' => ['id' => '[0-9]+'], 'uses' => 'ProfileController@show']);
        Route::resource('profile', 'ProfileController', ['only' => ['edit', 'update']]);
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

    /**
     * Mention Controllers
     */

    Route::group(['namespace' => 'Mention'], function () {

        /**
         * Mention Controllers
         */
        Route::group(['prefix' => 'mention/{id}', 'where' => ['id' => '[0-9]+'], 'middleware' => 'auth'], function () {

            Route::get('pin', [ 'as' => 'mention.pin', 'uses' => 'MentionController@pin']);
            Route::get('delete', [ 'as' => 'mention.delete', 'uses' => 'MentionController@delete']);
            Route::get('hide', [ 'as' => 'mention.hide', 'uses' => 'MentionController@hide']);
            Route::get('unhide', [ 'as' => 'mention.unhide', 'uses' => 'MentionController@unhide']);
        });

        /**
         * Mention-This Controllers
         */
        Route::group(['prefix' => 'mention-this', 'middleware' => 'auth'], function () {

            Route::get('', [ 'as' => 'mention.this', 'uses' => 'MentionThisController@start']);

            Route::get('/settings/{type}/{id}', [ 'where' => ['id' => '[0-9]+'], 'as' => 'mention.this.settings', 'uses' => 'MentionThisController@settings']);

            Route::post('/mention', ['as' => 'mention.this.do', 'uses' => 'MentionThisController@mention']);
        });

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