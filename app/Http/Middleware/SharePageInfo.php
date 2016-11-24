<?php namespace App\Http\Middleware;

use Closure;

use App\Models\MenuGroup;
use App\Models\MenuModule;
use App\Models\RouteInfo;

use Storage;

class SharePageInfo {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(count(MenuModule::where('route_id', '=' , RouteInfo::where('path', $request->path())->pluck('id'))->get()))
		{
			$route_group_info = MenuModule::where('route_id', '=' , RouteInfo::where('path', $request->path())->pluck('id'))->first()->mgro;
			$route_info = collect($route_group_info)->merge(RouteInfo::where('path', $request->path())->first());
		}
		else
		{
			$route_info = RouteInfo::where('path', $request->path())->first();
		}

		$res = Storage::disk('js')->exists("content/merchantcenter.js");

		if(Storage::disk('js')->exists($route_info['path'] . ".js")){
			$route_info['js_path'] = asset("js/" . $route_info['path'] . ".js");
		}

		if(Storage::disk('css')->exists($route_info['path'] . ".css")){
			$route_info['css_path'] = asset("css/" . $route_info['path'] . ".css");
		}

		view()->share('route', $route_info);

		return $next($request);
	}

}
