<?php namespace Gomention\Http\Controllers\Backend;

use Gomention\Http\Controllers\Controller;

/**
 * Class DashboardController
 * @package Gomention\Http\Controllers\Backend
 */
class DashboardController extends Controller {

	/**
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('backend.dashboard');
	}
}