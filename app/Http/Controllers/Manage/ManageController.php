<?php namespace App\Http\Controllers\Manage;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\RouteInfo;
use App\Models\MenuModule;


class ManageController extends Controller {

	public function getAddModule(Request $request)
	{

		return view('manage.addmodule');
	}

	public function postAddModule(Request $request)
	{
		$this->validate($request, [
            'modulename' => 'required',
            'moduleroute' => 'required',
            'assigngroup' => 'required',
        ]);

        $data = $request->only('modulename', 'moduleroute', 'assigngroup', 'quicklink');
        $route_id = RouteInfo::where('path', $data['moduleroute'])->pluck('id');
        if ($route_id > 0)
        {
        	if (count(MenuModule::where('route_path', $data['moduleroute'])->get()) == 0)
        	{
        		$mm = new MenuModule;
        		$mm->name = $data['modulename'];
        		$mm->route_path = $data['moduleroute'];
        		$mm->group_id = $data['assigngroup'];
        		$mm->route_id = $route_id;
        		if($data['quicklink'] == 'on')
        		{
        			$mm->quick_link = 1;
        		}
        		$mm->save();
        		$error = "add module success!";
        	}
        	else
        	{
        		$error = "sorry, this module is already exist!";
        	}
        }
        else
        {
        	$error = "sorry, don't have this route path!";
        }

        return redirect()->back()->withErrors([
                        'error' => $error,
                    ]);;

	}

}
