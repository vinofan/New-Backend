<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NormalMerchantGAMonitor extends Model
{
    public $table = "normalmerchant_ga_monitor";
    public $alias = "nmgm";

    public function nmgms()
    {
        $this->belongsTo('App\Models\NormalMerchantGAMonitorSet', 'MonID', 'ID');
    }
}
