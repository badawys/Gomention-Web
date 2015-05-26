<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Friendship\FriendshipContract;
use Illuminate\Support\Facades\Auth;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Frontend
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