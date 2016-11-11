<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NormalMerchant extends Model
{
    public $table = "normalmerchant";
    public $alias = "nm";

    protected $primaryKey = "ID";

    public function nma()
    {
        return $this->hasOne('App\Models\NormalMerchantAddinfo', 'ID', 'ID');
    }

    public function nmi()
    {
        return $this->hasMany('App\Models\NormalMerchantIndex', 'MerchantId', 'ID');
    }

    public function rmc()
    {
        return $this->hasMany('App\Models\RMerCategory', 'MerId', 'ID');
    }

    public function nmc()
    {
        return $this->belongsToMany('App\Models\NormalMerchantCategory', 'r_mer_category', 'MerId', 'CatId');
    }
}
