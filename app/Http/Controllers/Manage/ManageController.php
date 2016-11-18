<?php namespace App\Http\Controllers\Manage;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ManageController extends Controller {

	public function getAddModule(Request $request)
	{

		return view('manage.addmodule');
	}

	public function postAddModule()
	{
		
	}

}
