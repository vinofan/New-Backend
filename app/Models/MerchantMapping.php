<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantMapping extends Model
{
    public $table = "merchant_mapping";
    public $alias = "mm";
    
    public function nm()
    {
        return $this->belongsTo('App\Models\NormalMerchant', 'ToID', 'ID');
    }
}
