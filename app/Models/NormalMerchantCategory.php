<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NormalMerchantCategory extends Model
{
    public $table = "normalmerchantcategory";
    public $alias = "nmc";

    protected $primaryKey = "ID";

    public function rmc()
    {
        return $this->hasMany('App\Models\RMerCategory', 'CatId', 'ID');
    }

    public function nm()
    {
        return $this->belongsToMany('App\Models\NormalMerchant', 'r_mer_category', 'catId', 'merId');
    }
}
