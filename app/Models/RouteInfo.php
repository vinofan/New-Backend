<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouteInfo extends Model {

	public $table = 'route_info';
	public $alias = 'ri';

	public function mmod()
	{
		return $this->hasOne('App\Models\MenuModule', 'route_id', 'id');
	}

}
