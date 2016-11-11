<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NormalCouponApproval extends Model
{
    public $table = "normalcoupon_approval";
    public $alias = "ncal";

    protected $primaryKey = "ID";
}
