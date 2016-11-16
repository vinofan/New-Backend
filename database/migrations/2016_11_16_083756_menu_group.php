<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MenuGroup extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menu_group', function(Blueprint $table){
			$table->increments('id');
			$table->string('name')->index();
			$table->string('group_breadcrumb', 100);
			$table->integer('order')->nullable();
			$table->enum('group_permit', ['ADMIN', 'ENGINEER', 'EDITOR', 'GUEST'])->default('GUEST');
			$table->timestamp('created_at');
			$table->timestamp('updated_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('menu_group');
	}

}
