<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NormalMerchant404 extends Model
{
    public $table = "normalmerchant_404";
    public $alias = "nm4";

    protected $primaryKey = "ID";

    public function nma()
    {
        return $this->hasOne('App\Models\NormalMerchantAddinfo', 'ID', 'ID');
    }
}
