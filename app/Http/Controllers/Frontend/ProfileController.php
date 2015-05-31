<?php namespace Gomention\Http\Controllers\Frontend;

use Gomention\Http\Controllers\Controller;
use Gomention\Repositories\Frontend\User\UserContract;
use Gomention\Http\Requests\Frontend\User\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class ProfileController
 * @package Gomention\Http\Controllers\Frontend
 */
class ProfileController extends Controller {


	/**
	 * @param $id
	 * @return mixed
	 */
	public function edit($id) {
		return view('frontend.user.profile.edit')
			->withUser(auth()->user($id));
	}

	/**
	 * @param $id
	 * @param UserContract $user
	 * @param UpdateProfileRequest $request
	 * @return mixed
	 */
	public function update($id, UserContract $user, UpdateProfileRequest $request) {
		$user->updateProfile($id, $request->all());
		return redirect()->route('frontend.dashboard')->withFlashSuccess(trans('messages.frontend.profile.successfully_updated'));
	}

    public function show ($id, UserContract $users) {

        //Check if the
        $isAccepted = true;
        $isRequest = true;

        if (Auth::user()->friendsOfMineAndNotAccepted->find($id))
            $isAccepted = false;
        if (Auth::user()->friendOfAndNotAccepted->find($id))
            $isRequest = false;

        return view('frontend.user.profile.show')
            ->withUser($users->findOrThrowException($id, false))
            ->with('isFriend', Auth::user()->friends->find($id))
            ->with('isAccepted', $isAccepted )
            ->with('isRequest', $isRequest );
    }
}