<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NormalCouponAddinfo extends Model
{
    public $table = "normalcoupon_addinfo";
    public $alias = "nca";

    protected $primaryKey = "ID";

    public function nc()
    {
        return $this->belongsTo('App\Models\NormalCoupon', 'ID', 'ID');
    }
}
