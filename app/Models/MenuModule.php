<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuModule extends Model {

	public $table = "menu_module";
	public $alias = "mmod";

	public function mgro()
	{
		return $this->belongsTo('App\Models\MenuGroup', 'group_id', 'id');
	}

}
