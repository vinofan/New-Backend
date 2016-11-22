<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use File;
use App\Models\RouteInfo;

class AddPath extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'add:path';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a New Path To Database, View, Controller & Route.php.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire(RouteInfo $ri)
	{
		$path = $this->argument('path');
		$path_info = $this->option();

		list($controller_folder, $controller) = explode('/', $path);
		$view_folder = strtolower($controller_folder);
		$view = strtolower($controller);
		$path = strtolower($path);

        //insert to database
		$ri->path = $path;
		$ri->page_title = $path_info['title'];
		$ri->page_description = $path_info['remark'];
		$ri->page_breadcrumb = $path_info['breadcrumb'];
		$ri->permit = $path_info['permit'];

		$ri->save();

        //create view
		$view_path = "resources/views/{$view_folder}";
		$view_name = $view_path . "/$view.blade.php";
		$view_content = "@extends('common')\n@section('content')\n<div class=\"container\">\n</div>\n@endsection";
		if(!File::exists($view_path))
		{
			File::makeDirectory($view_path);
		}
		File::put($view_name, $view_content);

		//create controller
		if($path_info['controller'] && File::exists("app/Http/Controllers/" . $path_info['controller'] . ".php"))
		{
			$controller_name = "app/Http/Controllers/" . $path_info['controller'] . ".php";
			$route_content = "\n\nRoute::get('{$path}', '{$path_info['controller']}@get{$controller}');";	

			$controller_content = "\n\n"."    public function get{$controller}() {";
			$controller_content .= "\n\n"."		return view('" . str_replace("/", ".", $path) . "');";
			$controller_content .= "\n\n"."	}";
			$controller_content .= "\n\n"."}";

			$controller_file = rtrim(File::get($controller_name), '}') . $controller_content;
			File::put($controller_name , $controller_file);
		}
		else
		{
			$controller_path = "app/Http/Controllers/{$controller_folder}";
			$controller_name = $controller_path . "/{$controller}Controller.php";
			$route_content = "\n\nRoute::get('{$path}', '{$controller_folder}\\{$controller}Controller@get{$controller}');";

			$controller_content  = "<?php namespace App\Http\Controllers\\".$controller_folder.";";
			$controller_content .= "\n\n"."use App\Http\Requests;";
			$controller_content .= "\n"."use App\Http\Controllers\Controller;";
			$controller_content .= "\n\n"."use Illuminate\Http\Request;";
			$controller_content .= "\n\n"."class {$controller}Controller extends Controller {";
			$controller_content .= "\n\n"."    public function get{$controller}() {";
			$controller_content .= "\n\n"."		return view('" . str_replace("/", ".", $path) . "');";
			$controller_content .= "\n\n"."	}";
			$controller_content .= "\n\n"."}";

			if(!File::exists($controller_path))
			{
				File::makeDirectory($controller_path);
			}
			File::put($controller_name, $controller_content);       
		}

		//append route
		File::append("app/Http/path_routes.php", $route_content);

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
		['path', InputArgument::REQUIRED],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
		['title', null, InputOption::VALUE_REQUIRED, "Path's Page Title ", ""],
		['remark', null, InputOption::VALUE_OPTIONAL, "Path's Page Description ", ""],
		['permit', null, InputOption::VALUE_OPTIONAL, "Path's Authorize ", "GUEST"],
		['breadcrumb', null, InputOption::VALUE_OPTIONAL, "Path's Page BreadCrumb ", ""],
		['controller', null, InputOption::VALUE_OPTIONAL, "Path's Controller ", null],
		];
	}

}
