<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NormalCoupon extends Model
{
    public $table = "normalcoupon";
    public $alias = "nc";

    protected $primaryKey = "ID";

    public function nm()
    {
        return $this->belongsTo('App\Models\NormalMerchant', 'MerchantId', 'ID');
    }
}
