<?php namespace Gomention\Providers;

use Illuminate\Support\ServiceProvider;

class FriendshipServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
            'Gomention\Repositories\Frontend\Friendship\FriendshipContract',
            'Gomention\Repositories\Frontend\Friendship\EloquentFriendshipRepository'
        );
	}

}
