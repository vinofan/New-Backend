<?php namespace App\Http\Controllers\System;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ManageController extends Controller {

	public function getAddModule()
	{
		return view('manage.module');
	}

	public function postAddModule()
	{

	}

}
