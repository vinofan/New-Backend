<?php namespace App\Http\Controllers\System;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ManageController extends Controller {

	public function getAddModule(Request $request)
	{
		$page_info = [
			'route' => $request->route,
			'groups' => $request->groups,
		];
		
		return view('manage.module', $page_info);
	}

	public function postAddModule()
	{

	}

}
