<?php namespace Gomention\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		/**
		 * Frontend Events
		 */
		'Gomention\Events\Frontend\Auth\UserLoggedIn' => [
			'Gomention\Handlers\Events\Frontend\Auth\UserLoggedInHandler',
		],
		'Gomention\Events\Frontend\Auth\UserLoggedOut' => [
			'Gomention\Handlers\Events\Frontend\Auth\UserLoggedOutHandler',
		],
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		//
	}
}