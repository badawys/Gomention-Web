<?php

Route::group(['prefix' => 'friends','middleware' => 'auth'], function () {

    Route::get('/add/{id}', [ 'as' => 'AddFriend', 'uses' => 'Friendship@AddFriend']);
    Route::get('/remove/{id}', [ 'as' => 'RemoveFriend', 'uses' => 'Friendship@RemoveFriend']);
    Route::get('/accept/{id}', [ 'as' => 'AcceptFriend', 'uses' => 'Friendship@AcceptFriend']);
    Route::get('/decline/{id}', [ 'as' => 'DeclineFriend', 'uses' => 'Friendship@DeclineFriend']);
    Route::get('/remove_request/{id}', [ 'as' => 'RemoveFriendRequest', 'uses' => 'Friendship@RemoveFriendRequest']);
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
	});
});