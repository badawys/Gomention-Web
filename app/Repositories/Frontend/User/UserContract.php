<?php namespace Gomention\Repositories\Frontend\User;

/**
 * Interface UserContract
 * @package Gomention\Repositories\User
 */
interface UserContract {

	/**
	 * @param $data
	 * @return mixed
	 */
	public function create($data);

	/**
	 * @param $data
	 * @return mixed
	 */
	public function findByUserNameOrCreate($data, $provider);

	/**
	 * @param $provider
	 * @param $providerData
	 * @param $user
	 * @return mixed
	 */
	public function checkIfUserNeedsUpdating($provider, $providerData, $user);

	/**
	 * @param $id
	 * @param $input
	 * @return mixed
	 */
	public function updateProfile($id, $input);

	/**
	 * @param $input
	 * @return mixed
	 */
	public function changePassword($input);

	/**
	 * @param $token
	 * @return mixed
	 */
	public function confirmAccount($token);

	/**
	 * @param $user
	 * @return mixed
	 */
	public function sendConfirmationEmail($user);
}