<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponStats extends Model
{
    public $table = "coupon_stats";
    public $alias = "cs";

    public function nc()
    {
        return $this->belongsTo('App\Models\NormalCoupon', 'CouponId', 'ID');
    }
}
