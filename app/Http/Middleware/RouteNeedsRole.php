<?php namespace Gomention\Http\Middleware;

use Closure;
use Gomention\Services\Access\Traits\AccessRoute;

/**
 * Class RouteNeedsRole
 * @package Gomention\Http\Middleware
 */
class RouteNeedsRole {

	use AccessRoute;

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$assets = $this->getAssets($request);

		if (! access()->hasRoles($assets['roles'], $assets['needsAll']))
			return $this->getRedirectMethodAndGo($request);

		return $next($request);
	}
}
