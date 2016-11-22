<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\NormalMerchant;


class TestPaginateController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$merchants = NormalMerchant::Paginate(3);
		return view('test')->with('merchants', $merchants);
	}

}
