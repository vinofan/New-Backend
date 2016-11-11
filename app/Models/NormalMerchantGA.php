<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NormalMerchantGA extends Model
{
    public $table = "normalmerchant_ga";
    public $alias = "nmg";

    public function nm()
    {
        return $this->belongsTo('App\Models\NormalMerchant', 'MID', 'ID');
    }
}
