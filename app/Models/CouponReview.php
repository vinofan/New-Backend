<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponReview extends Model
{
    public $table = "couponreview";
    public $alias = "cr";

    protected $primaryKey = "ID";

    public function nc()
    {
        return $this->belongsTo('App\Models\NormalCoupon', 'CouponID', 'ID');
    }
}
