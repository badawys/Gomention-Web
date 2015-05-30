<?php namespace Gomention\Repositories\Backend\Permission;

/**
 * Interface PermissionRepositoryContract
 * @package Gomention\Repositories\Permission
 */
interface PermissionRepositoryContract {

	/**
	 * @param $id
	 * @param bool $withRoles
	 * @return mixed
	 */
	public function findOrThrowException($id, $withRoles = false);

	/**
	 * @param $per_page
	 * @param string $order_by
	 * @param string $sort
	 * @return mixed
	 */
	public function getPermissionsPaginated($per_page, $order_by = 'id', $sort = 'asc');

	/**
	 * @param string $order_by
	 * @param string $sort
	 * @param bool $withRoles
	 * @return mixed
	 */
	public function getAllPermissions($order_by = 'id', $sort = 'asc', $withRoles = true);

	/**
	 * @return mixed
	 */
	public function getPermissionsNotAssociatedWithUser();

	/**
	 * @return mixed
	 */
	public function getPermissionsNotAssociatedWithRole();

	/**
	 * @param $input
	 * @param $roles
	 * @return mixed
	 */
	public function create($input, $roles);

	/**
	 * @param $id
	 * @param $input
	 * @param $roles
	 * @return mixed
	 */
	public function update($id, $input, $roles);

	/**
	 * @param $id
	 * @return mixed
	 */
	public function destroy($id);
}