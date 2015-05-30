<?php namespace Gomention\Services\Access\Facades;

/**
 * Class Access
 * @package Gomention\Services\Access\Facades
 */
class Access extends \Illuminate\Support\Facades\Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'access';
	}
}