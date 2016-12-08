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
		DB::table('menu_module')->insert(['id' => '3', 'name' => 'Merchant Center', 'route_path' => 'content/merchantcenter', 'route_id' => 8, 'quick_link' => 1, 'group_id' => 1]);
		DB::table('route_info')->insert(['id' => 'content/merchantcenter', 'page_title' => 'Merchant Center', 'page_breadcrumb' => 'merchant center', 'permit' => 'EDITOR']);
	}
}