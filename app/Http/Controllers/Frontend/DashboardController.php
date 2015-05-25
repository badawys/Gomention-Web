<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Frontend
 */
class DashboardController extends Controller {

	/**
	 * @return mixed
	 */
	public function index()
	{

		return view('frontend.user.dashboard')
			->withUser(auth()->user())
            ->with('friends', Auth::user()->friends)
            ->with('requests', Auth::user()->friendOfAndNotAccepted);
	}
}