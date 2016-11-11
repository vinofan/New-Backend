<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShareSaving extends Model
{
    public $table = "share_saving";
    public $alias = "ss";

    protected $primaryKey = "ID";

    public function nc()
    {
        return $this->belongsTo('App\Models\NormalCoupon', 'CouponID', 'ID');
    }

    public function nm()
    {
        return $this->belongsTo('App\Models\NormalMerchant', 'MerchantID', 'ID');
    }
}
