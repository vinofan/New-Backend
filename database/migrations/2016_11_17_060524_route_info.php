<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RouteInfo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('route_info', function(Blueprint $table){
			$table->increments('id');
			$table->string('path', 100);
			$table->string('page_title', 100);
			$table->text('page_description');
			$table->string('page_breadcrumb', 100);
			$table->enum('permit', ['ADMIN', 'ENGINEER', 'EDITOR', 'GUEST'])->default('GUEST');
			$table->timestamp('created_at');
			$table->timestamp('updated_at');
			$table->unique('path');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('route_info');
	}

}
