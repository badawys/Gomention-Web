<?php

/**
 * Test Routes
 */
Route::get('/mention', function (\Gomention\Repositories\Frontend\Mention\MentionContract $mention){


    $mention->textMention(
        '3', //Target User id
        [
            'type' => 'video',
            'src' => "https://www.youtube.com/embed/Ue4PCI0NamI" //Mention Data
        ]);


    dd(Auth::user()->mentions()->get()->toArray());

});


Route::get('/hello', function (){

    $q = Embedly::extract(['www.aljazeera.net/news/cultureandart/2015/7/13/%D8%AA%D8%B9%D9%84%D9%85-%D8%A7%D9%84%D8%B9%D8%B1%D8%A8%D9%8A%D8%A9-%D9%8A%D9%86%D8%AA%D8%B4%D8%B1-%D9%81%D9%8A-%D8%A8%D8%B1%D9%8A%D8%B7%D8%A7%D9%86%D9%8A%D8%A7'],[

        'maxwidth' => '554'

    ]);

    return dd($q);
//    if ($q->error)
//        return $q->error_code;
//
//    return $q->content;
});

Route::get('/mentions', function () {

    dd(Auth::user()->mentions()->get()->toArray());

});


/*****************************************************
 * ***************************************************
 * ***************************************************
 * ***************************************************
 * ***************************************************
 * ***************************************************
 * *******************TEST END************************
 * ***************************************************
 * ***************************************************
 * ***************************************************
 * ***************************************************
 * ***************************************************
 ****************************************************/



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

            Route::get('/photo/{id}', [ 'as' => 'mention.this.photo', 'uses' => 'MentionThisController@photo']);
            Route::get('/video/{id}', [ 'as' => 'mention.this.video', 'uses' => 'MentionThisController@video']);
            Route::get('/link/{id}', [ 'as' => 'mention.this.link', 'uses' => 'MentionThisController@link']);
            Route::get('/article/{id}', [ 'as' => 'mention.this.article', 'uses' => 'MentionThisController@article']);

            Route::get('/{type}/{id}/friends', [ 'where' => ['id' => '[0-9]+'], 'as' => 'mention.this.friends', 'uses' => 'MentionThisController@friends']);
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