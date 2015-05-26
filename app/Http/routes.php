<?php

Route::group(['prefix' => 'friends','middleware' => 'auth', 'namespace' => 'Frontend'], function () {

    Route::get('/add/{id}', [ 'as' => 'AddFriend', 'uses' => 'FriendshipController@AddFriend']);
    Route::get('/remove/{id}', [ 'as' => 'RemoveFriend', 'uses' => 'FriendshipController@RemoveFriend']);
    Route::get('/accept/{id}', [ 'as' => 'AcceptFriend', 'uses' => 'FriendshipController@AcceptFriend']);
    Route::get('/decline/{id}', [ 'as' => 'DeclineFriend', 'uses' => 'FriendshipController@DeclineFriend']);
    Route::get('/remove_request/{id}', [ 'as' => 'RemoveFriendRequest', 'uses' => 'FriendshipController@RemoveFriendRequest']);
});


/**
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend'], function ()
{
	require_once(__DIR__ . "/Routes/Frontend/Frontend.php");
	require_once(__DIR__ . "/Routes/Frontend/Access.php");
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