<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RMerCategory extends Model
{
    public $table = "r_mer_category";
    public $alias = "rmc";

    public function nm()
    {
        return $this->belongsTo('App\Models\NormalMerchant', 'MerId', 'ID');
    }

    public function nmc()
    {
        return $this->belongsTo('App\Models\NormalMerchantCategory', 'CatId', 'ID');
    }
}
