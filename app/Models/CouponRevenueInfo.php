<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponRevenueInfo extends Model
{
    public $table = "coupon_revenue_info";
    public $alias = "cri";

    protected $primaryKey = "ID";

    public function nc()
    {
        return $this->belongsTo('App\Models\NormalCoupon', 'CouponID', 'ID');
    }
}
