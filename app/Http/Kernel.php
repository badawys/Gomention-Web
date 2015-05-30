<?php namespace Gomention\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		'Gomention\Http\Middleware\VerifyCsrfToken',
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'auth' => 'Gomention\Http\Middleware\Authenticate',
		'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
		'guest' => 'Gomention\Http\Middleware\RedirectIfAuthenticated',

		'access.routeNeedsRole' => 'Gomention\Http\Middleware\RouteNeedsRole',
		'access.routeNeedsPermission' => 'Gomention\Http\Middleware\RouteNeedsPermission',
		'access.routeNeedsRoleOrPermission' => 'Gomention\Http\Middleware\RouteNeedsRoleOrPermission',
	];
}
