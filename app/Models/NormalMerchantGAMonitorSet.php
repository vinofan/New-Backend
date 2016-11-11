<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NormalMerchantGAMonitorSet extends Model
{
    public $table = "normalmerchant_ga_monitor_set";
    public $alias = "nmgms";

    protected $primaryKey = "ID";

    public function nmgm()
    {
        return $this->hasMany('App\Models\NormalMerchantGAMonitor', 'MonID', 'ID');
    }
}
