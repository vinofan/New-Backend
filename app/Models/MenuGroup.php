<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuGroup extends Model {

	public $table = "menu_group";
	public $alias = "mgro";

	public function mmod()
	{
		return $this->hasMany('App\Models\MenuModule', 'group_id', 'id');
	}

}
