<?php 
namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\NormalCoupon;

class IndexController extends Controller {
    public function index(Request $request)
    {	
    	//echo 111;die;
    	$user = NormalCoupon::find(2);
    	dd($user->Title);
    	die;
    		
        return view('common',['username'=>$request->user()->user_name]);
    }
}