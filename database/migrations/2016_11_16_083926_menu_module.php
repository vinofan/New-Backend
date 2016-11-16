<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MenuModule extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menu_module', function(Blueprint $table){
			$table->increments('id');
			$table->string('route', 100);
			$table->string('page_title', 100);
			$table->text('page_description');
			$table->string('page_breadcrumb', 100);
			$table->enum('quick_link', [0,1])->default(0);
			$table->enum('permit', ['ADMIN', 'ENGINEER', 'EDITOR', 'GUEST'])->default('GUEST');
			$table->integer('group_id');
			$table->timestamp('created_at');
			$table->timestamp('updated_at');
			$table->unique('route');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('menu_module');
	}

}
