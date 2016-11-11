<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NormalMerchantIndex extends Model
{
    public $table = 'normalmerchant_index';
    public $alias = 'nmi';

    public function nma()
    {
        return $this->belongsTo('App\Models\NormalMerchant', 'MerchantId', 'ID');
    }
}
