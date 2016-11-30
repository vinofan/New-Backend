<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskStoreRelatedUrl extends Model {

	public $connection = "task";
	public $table = "store_related_url";
	public $alias = "tsru";

	public function tsmr()
	{
		return $this->belongsTo('App\Models\TaskStoreMerchantRelationship', 'StoreId', 'StoreID');
	}

}
