<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\MenuGroup;
use App\Models\MenuModule;

class MenuServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$groups_info = MenuGroup::all();
		$groups_info->map(function ($item) {
    		$item->module = MenuModule::where('group_id', '=', $item->id)->get();
    		return $item;
		});

		view()->share('groups', $groups_info);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
