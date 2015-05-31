<?php namespace Gomention\Events\Frontend\Auth;

use Gomention\Events\Event;
use Illuminate\Queue\SerializesModels;

/**
 * Class UserLoggedIn
 * @package Gomention\Events\Frontend\Auth
 */
class UserLoggedIn extends Event {

	use SerializesModels;

	/**
	 * @var $user
	 */
	public $user;

	/**
	 * @param $user
	 */
	public function __construct($user)
	{
		$this->user = $user;
	}
}
