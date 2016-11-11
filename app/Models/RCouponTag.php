<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RCouponTag extends Model
{
    public $table = "r_coupontag";
    public $alias = "rct";

    public function nc()
    {
        return $this->belongsTo('App\Models\NormalCoupon', 'CouponID', 'ID');
    }

    public function t()
    {
        return $this->belongsTo('App\Models\Tag', 'TagID', 'ID');
    }
}
