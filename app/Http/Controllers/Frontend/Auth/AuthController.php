<?php namespace Gomention\Http\Controllers\Frontend\Auth;

use Gomention\Services\Registrar;
use Illuminate\Http\Request;
use Gomention\Http\Controllers\Controller;
use Gomention\Http\Requests\Frontend\Access\LoginRequest;
use Gomention\Http\Requests\Frontend\Access\RegisterRequest;
use Gomention\Exceptions\GeneralException;

/**
 * Class AuthController
 * @package Gomention\Http\Controllers\Frontend\Auth
 */
class AuthController extends Controller {

	/**
	 * @param Registrar $registrar
	 */
	public function __construct(Registrar $registrar)
	{
		$this->registrar = $registrar;
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function getRegister() {
		return view('frontend.auth.register');
	}

	/**
	 * @param RegisterRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postRegister(RegisterRequest $request)
	{
		if (config('access.users.confirm_email')) {
			$this->registrar->create($request->all());
			return redirect()->route('home')->withFlashSuccess("Your account was successfully created. We have sent you an e-mail to confirm your account.");
		} else {
			$this->registrar->login($this->registrar->create($request->all()));
			return redirect()->route('frontend.dashboard');
		}
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function getLogin() {
		return view('frontend.auth.login');
	}

	/**
	 * @param LoginRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postLogin(LoginRequest $request)
	{
		//Don't know why the exception handler is not catching this
		try {
			$this->registrar->login($request);
			return redirect()->intended('/dashboard');
		} catch (GeneralException $e) {
			return redirect()->back()->withInput()->withFlashDanger($e->getMessage());
		}
	}

	/**
	 * @param Request $request
	 * @param $provider
	 * @return mixed
	 */
	public function loginThirdParty(Request $request, $provider) {
		return $this->registrar->loginThirdParty($request->all(), $provider);
	}

	/**
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getLogout()
	{
		$this->registrar->logout();
		return redirect()->route('home');
	}

	/**
	 * @param $token
	 * @return mixed
	 * @throws \Gomention\Exceptions\GeneralException
	 */
	public function confirmAccount($token) {
		//Don't know why the exception handler is not catching this
		try {
			$this->registrar->confirmAccount($token);
			return redirect()->route('frontend.dashboard')->withFlashSuccess("Your account has been successfully confirmed!");
		} catch (GeneralException $e) {
			return redirect()->back()->withInput()->withFlashDanger($e->getMessage());
		}
	}

	/**
	 * @param $user_id
	 * @return mixed
	 */
	public function resendConfirmationEmail($user_id) {
		//Don't know why the exception handler is not catching this
		try {
			$this->registrar->resendConfirmationEmail($user_id);
			return redirect()->route('home')->withFlashSuccess("A new confirmation e-mail has been sent to the address on file.");
		} catch (GeneralException $e) {
			return redirect()->back()->withInput()->withFlashDanger($e->getMessage());
		}
	}
}
