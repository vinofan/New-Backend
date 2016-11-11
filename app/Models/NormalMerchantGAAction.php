<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NormalMerchantGAAction extends Model
{
    public $table = "normalmerchant_ga_action";
    public $alias = "nmga";

    protected $primaryKey = "ID";

    public function nm()
    {
        return $this->belongsTo('App\Models\NormalMerchant', 'MID', 'ID');
    }
}
