<?php namespace Gomention\Providers;

use Illuminate\Support\ServiceProvider;

class MentionServiceProvider extends ServiceProvider {

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
            'Gomention\Repositories\Frontend\Mention\MentionContract',
            'Gomention\Repositories\Frontend\Mention\EloquentMentionRepository'
        );
	}

}
