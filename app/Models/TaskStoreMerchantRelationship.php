<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskStoreMerchantRelationship extends Model {

	protected $connection = "task";
	public $table = "store_merchant_relationship";
	public $alias = "tsmr";

	public function nm()
	{
		return $this->belongsTo('App\Models\NormalMerchant', 'MerchantID', 'ID');
	}

	public function tsru()
	{
		return $this->hasMany('App\Models\TaskStoreRelatedUrl', 'StoreId', 'StoreID');
	}

}
