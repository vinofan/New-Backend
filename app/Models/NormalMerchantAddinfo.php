<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NormalMerchantAddinfo extends Model
{
    public $table = 'normalmerchant_addinfo';
    public $alias = 'nma';

    protected $primaryKey = "ID";

    public function nm()
    {
        return $this->belongsTo('App\Models\NormalMerchant', 'ID', 'ID');
    }

    public function nm4()
    {
        return $this->belongsTo('App\Models\NormalMerchant404', 'ID', 'ID');
    }
}
