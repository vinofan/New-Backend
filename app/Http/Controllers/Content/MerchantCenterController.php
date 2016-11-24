<?php namespace App\Http\Controllers\Content;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use File;

class MerchantCenterController extends Controller {

    public function getMerchantCenter() {

		return view('content.merchantcenter');

	}

}