<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantSearchFilter extends Model
{
    public $table = "merchant_search_filter";
    public $alias = "msf";

    protected $primaryKey = "MerchantId";

    public function nm()
    {
        return $this->belongsTo('App\Models\NormalMerchant', 'MerchantId', 'ID');
    }
}
