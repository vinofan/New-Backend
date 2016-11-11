<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NormalCouponStats extends Model
{
    public $table = "normalcoupon_stats";
    public $alias = "ncs";

    protected $primaryKey = "ID";

    public function nc()
    {
        return $this->belongsTo('App\Models\NormalCoupon', 'CouponId', 'ID');
    }
}
