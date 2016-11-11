<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantDailyCouponCount extends Model
{
    public $table = "merchant_daily_coupon_count";
    public $alias = "mdcc";

    protected $primaryKey = "MerchantID";

    public function nm()
    {
        return $this->belongsTo('App\Models\NormalMerchant', 'MerchantID', 'ID');
    }
}
