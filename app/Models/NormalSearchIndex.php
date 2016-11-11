<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NormalSearchIndex extends Model
{
    public $table = "normalsearchindex";
    public $alias = "nsi";

    public function nm()
    {
        return $this->belongsTo('App\Models\NormalMerchant', 'MerchantID', 'ID');
    }
}
