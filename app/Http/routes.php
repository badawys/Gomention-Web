<?php

Route::group(['middleware' => 'auth'], function () {

    Route::get('/friends/list', 'Friendship@GetFriends' );
    Route::get('/friends/list/by_me', 'Friendship@GetFriendsAddedByUser' );
    Route::get('/friends/list/to_me', 'Friendship@GetFriendsAddedToUser' );
    Route::get('/friends/add/{id}', [ 'as' => 'AddFriend', 'uses' => 'Friendship@AddFriend']);
    Route::get('/friends/remove/{id}', [ 'as' => 'RemoveFriend', 'uses' => 'Friendship@RemoveFriend']);
    Route::get('/friends/requests', 'Friendship@GetFriendsRequests' );
    Route::get('/friends/requests/sent', 'Friendship@GetFriendsSentRequests' );

});


Route::get('/friends/', function()
{

    //Add Friend
    /*$user = \App\User::find(4);
    \App\User::find(3)->addFriend($user);*/

    //Remove Friend
    /*$user = \App\User::find(4);
    \App\User::find(3)->removeFriend($user);*/

    //Get  All friendship list
    /*$user = \App\User::find(3)->friends->toArray();*/

    //Get  all friendship that user started
    /*$user = \App\User::find(3)->friendsOfMine->toArray();*/

    //Get  all friendship that user was invited to
    /*$user = \App\User::find(3)->friendOf->toArray();*/

    //Get  all friendship that user started and not accepted
    /*$user = \App\User::find(3)->friendsOfMineAndNotAccepted->toArray();*/

    //Get  all friendship that user was invited to and not accepted
    /*$user = \App\User::find(3)->friendOfAndNotAccepted->toArray();*/

    // Check the accepted value
    /*$isAccepted = \App\User::find(3)->friends->first()->pivot->accepted;*/

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