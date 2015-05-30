<?php namespace Gomention\Http\Controllers\Frontend;

use Gomention\Http\Controllers\Controller;
use Gomention\Repositories\Frontend\Friendship\FriendshipContract;
use Illuminate\Support\Facades\Auth;

/**
 * Class DashboardController
 * @package Gomention\Http\Controllers\Frontend
 */
class DashboardController extends Controller {

	/**
	 * @return mixed
	 */
	public function index(FriendshipContract $friendship)
	{

		return view('frontend.user.dashboard')
			->withUser(auth()->user())
            ->with('friends', $friendship->getAllFriends())
            ->with('requests', $friendship->getFriendsRequests());
	}
}