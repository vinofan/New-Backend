<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('MenuSeeder');
	}
}

/**
* 
*/
class MenuSeeder extends Seeder
{
	
	public function run()
	{
		DB::table('menu_group')->where('id', 1)->update(['fa_css' => 'fa fa-file-text-o']);
		DB::table('menu_group')->where('id', 2)->update(['fa_css' => 'fa fa-line-chart']);
		DB::table('menu_group')->where('id', 3)->update(['fa_css' => 'fa fa-cloud-download']);
		DB::table('menu_group')->where('id', 4)->update(['fa_css' => 'fa fa-pencil']);
	}
}