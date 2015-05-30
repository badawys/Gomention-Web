<?php namespace Gomention\Providers;

use Gomention\Services\Access\Access;
use Illuminate\Support\ServiceProvider;
use Gomention\Blade\Access\AccessBladeExtender;

/**
 * Class AccessServiceProvider
 * @package Gomention\Providers
 */
class AccessServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Package boot method
	 */
	public function boot() {
		$this->registerBladeExtender();
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerAccess();
		$this->registerFacade();
		$this->registerBindings();
	}

	/**
	 * Register the application bindings.
	 *
	 * @return void
	 */
	private function registerAccess()
	{
		$this->app->bind('access', function($app) {
			return new Access($app);
		});
	}

	/**
	 * Register the vault facade without the user having to add it to the app.php file.
	 *
	 * @return void
	 */
	public function registerFacade() {
		$this->app->booting(function()
		{
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('Access', 'Gomention\Services\Access\Facades\Access');
		});
	}

	/**
	 * Register service provider bindings
	 */
	public function registerBindings() {
		$this->app->bind(
			'Gomention\Repositories\Frontend\User\UserContract',
			'Gomention\Repositories\Frontend\User\EloquentUserRepository'
		);

		$this->app->bind(
			'Gomention\Repositories\Backend\User\UserContract',
			'Gomention\Repositories\Backend\User\EloquentUserRepository'
		);

		$this->app->bind(
			'Gomention\Repositories\Backend\Role\RoleRepositoryContract',
			'Gomention\Repositories\Backend\Role\EloquentRoleRepository'
		);

		$this->app->bind(
			'Gomention\Repositories\Backend\Permission\PermissionRepositoryContract',
			'Gomention\Repositories\Backend\Permission\EloquentPermissionRepository'
		);
	}

	/**
	 * Register the blade extender to use new blade sections
	 */
	protected function registerBladeExtender() {
		AccessBladeExtender::attach($this->app);
	}
}