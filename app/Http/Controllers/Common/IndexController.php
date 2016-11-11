<?php 
namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller {
    public function index(Request $request)
    {
    		
        return view('common',['username'=>$request->user()->user_name]);
    }
}