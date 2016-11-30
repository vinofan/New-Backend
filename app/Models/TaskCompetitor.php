<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskCompetitor extends Model {

	public $connection = "task";
	public $table = "competitor";
	public $alias = "tc";

	public function tscr()
	{
		return $this->hasMany('App\Models\TaskStoreCompetitorRelationship', 'CompetitorId', 'ID');
	}
}
