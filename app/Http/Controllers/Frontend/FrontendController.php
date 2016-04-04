<?php namespace Gomention\Http\Controllers\Frontend;

use Gomention\Exceptions\GeneralException;
use Gomention\Http\Controllers\Controller;
use Gomention\Mention;
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

    public function viewMention ($id, FriendshipContract $friendship) {

        $mention = Mention::find($id);

		if (($mention) && (Auth::user()->id == ($mention->by_user_id || $mention->to_user_id))) {

			if (\Request::ajax()){
				return view('frontend.user.mention.page.ajax')
					->with('mention', $mention);
			} else {
//				return view('frontend.user.mention.page.normal')
//					->with('friends', $friendship->getAllFriends())
//					->with('mention', $mention);
				abort(404);
			}
		}


        //TODO: better error handling
        throw new GeneralException("Can't find this mention");
    }

}
