<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

use App\Models\RouteInfo;

use Config;

class Authenticate {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ($this->auth->guest())
		{
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
				return redirect()->guest('admin/login');
			}
		}

		$user = $this->auth->user();
		if (!$this->checkAuth($user['auth'], $request->path()))
		{
			return response('Unauthorized.', 401);
		}
		
		return $next($request);
	}

	public function checkAuth($permit, $path)
	{
		$permit_rank = Config::get("constants.$permit");
		
		$path_permit = RouteInfo::where('path', $path)->pluck('permit');
		$path_rank = Config::get("constants.$path_permit");

		if($permit_rank <= $path_rank || $path_rank == null)
		{
			return true;
		}

		return false;
	}

}
