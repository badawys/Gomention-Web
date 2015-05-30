<?php namespace Gomention\Http\Controllers\Frontend;

use Gomention\Http\Controllers\Controller;

/**
 * Class FrontendController
 * @package Gomention\Http\Controllers
 */
class FrontendController extends Controller {

	/**
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('frontend.index');
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function macros()
	{
		return view('frontend.macros');
	}
}