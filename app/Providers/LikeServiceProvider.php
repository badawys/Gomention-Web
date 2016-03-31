<?php namespace Gomention\Providers;

use Illuminate\Support\ServiceProvider;

class LikeServiceProvider extends ServiceProvider {

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
            'Gomention\Repositories\Frontend\Like\LikeContract',
            'Gomention\Repositories\Frontend\Like\EloquentLikeRepository'
        );
	}

}
