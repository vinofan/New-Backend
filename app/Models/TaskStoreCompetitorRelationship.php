<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskStoreCompetitorRelationship extends Model {

		public $connection = "task";
	public $table = "store_competitor_relationship";
	public $alias = "tscr";

	public function tsmr()
	{
		return $this->belongsTo('App\Models\TaskStoreMerchantRelationship', 'StoreID', 'StoreID');
	}

	public function scopeWithTC($query)
	{
		return $query->leftjoin("competitor as tc", 'tc.ID', '=', 'store_competitor_relationship.CompetitorId')->select("tc.Name", "store_competitor_relationship.Url");
	}
}
