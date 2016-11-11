<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantStats extends Model
{
    public $table = "merchant_stats";
    public $alias = "ms";


    public function nm()
    {
        return $this->belongsTo('App\Models\NormalMerchant', 'MerchantId', 'ID');
    }
}
