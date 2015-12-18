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
                ->withMentions(Auth::user()->mentions()->paginate(10));

        return view('frontend.index');
	}
}