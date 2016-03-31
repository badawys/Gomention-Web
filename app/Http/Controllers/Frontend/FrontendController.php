<?php namespace Gomention\Http\Controllers\Frontend;

use Gomention\Http\Controllers\Controller;
use Gomention\Repositories\Frontend\Friendship\FriendshipContract;
use Illuminate\Support\Facades\Auth;

/**
 * Class FrontendController
 * @package Gomention\Http\Controllers
 */
class FrontendController extends Controller {

    /**
     * @param FriendshipContract $friendship
     * @return \Illuminate\View\View
     */
	public function index(FriendshipContract $friendship)
	{
        if (Auth::user())
            return view('frontend.user.mention.feed')
                ->withUser(auth()->user())
                ->with('friends', $friendship->getAllFriends());

        return view('frontend.index');
	}

    public function mentions($id, FriendshipContract $friendship)
    {

        $selectedUser = \Gomention\User::find($id);

        return view('frontend.user.mention.feed')
            ->withUser(auth()->user())
            ->with('friends', $friendship->getAllFriends())
            ->withMentions(Auth::user()->userMentions($selectedUser)->paginate(10))
            ->withSelected($selectedUser);
    }


}