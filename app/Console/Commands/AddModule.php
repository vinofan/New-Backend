<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use App\Models\RouteInfo;
use File;

class AddModule extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'add:module';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Display an inspiring quote';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['path', InputArgument::REQUIRED, ''],
			//['controller_name', InputArgument::OPTIONAL, ''],
			['page_title', InputArgument::OPTIONAL, '','Title'],
			['page_description', InputArgument::OPTIONAL, '','Description'],
			['page_breadcrumb', InputArgument::OPTIONAL, '','Breadcrumb'],
			['permit', InputArgument::OPTIONAL, '','GUEST'],
			

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
			['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}

	public function handle()
	{	
		$path = $this->argument('path');
		//$controller_name = $this->argument('controller_name');
		$page_title = addslashes($this->argument('page_title'));
		$page_description = addslashes($this->argument('page_description'));
		$page_breadcrumb = addslashes($this->argument('page_breadcrumb'));
		$permit = $this->argument('permit');
		

		// RouteInfo::insert(
		// 	  ['path' 			  => $path ,
		// 	   'controller_name'  => $controller_name ,
		// 	   'page_title'  	  => $page_title ,
		// 	   'page_description' => $page_description ,
		// 	   'page_breadcrumb'  => $page_breadcrumb ,
		// 	   'permit' 	      => $permit ,
		// 	  ]
		// );
		
		$path = explode('/',$path);
		$folder = ucfirst($path[0]);
		$controller_name = ucfirst($path[1]);

		$routeContent = "\n\n"."Route::get('".$path."', '".$folder."\\".$controller_name."Controller@get".$controller_name."');";

		$controllerContent  = "<?php namespace App\Http\Controllers\\".$folder.";";
		$controllerContent .= "\n\n"."use App\Http\Controllers\Controller;";
		$controllerContent .= "\n\n"."class ".$controller_name."Controller extends Controller {";
		$controllerContent .= "\n\n"."    public function get".$controller_name."() {";
		$controllerContent .= "\n\n"."		return view('".$path[0].".".$path[1]."');";
		$controllerContent .= "\n\n"."	}";
		$controllerContent .= "\n\n"."}";

		$viewContent = $page_title;
		$viewContent .= "<br />".$page_description;

		$controllerPath = "app/Http/Controllers/".$folder."/".$controller_name."Controller.php";
		$viewPath = "resources/views/".$path[0]."/".$path[1].".blade.php";

		//生成路由
		File::append("app/Http/routes.php",$routeContent);

		//生成控制器
		File::exists($controllerPath,  $mode = 0777, $recursive = false);
		File::append($controllerPath, $controllerContent);

		//生成视图
		File::exists($viewPath,  $mode = 0777, $recursive = false);
		File::append($viewPath, $viewContent);
		
	}
}
