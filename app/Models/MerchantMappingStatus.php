<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantMappingStatus extends Model
{
    public $table = "merchant_mapping_status";
    public $alias = "mms";

    protected $primaryKey = "ID";

    public function nm()
    {
        return $this->belongsTo('App\Models\NormalMerchantGAMonitor', 'ToID', 'ID');
    }
}
