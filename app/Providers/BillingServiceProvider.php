<?php namespace Gomention\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class BillingServiceProvider
 * @package Gomention\Providers
 */
class BillingServiceProvider extends ServiceProvider {

	/**
	 *
	 */
	public function boot()
	{
		//
	}

	/**
	 *
	 */
	public function register()
	{
		$this->app->bind(
			'Gomention\Services\Billing\BillingContract',
			'Gomention\Services\Billing\StripeGateway'
		);
	}
}