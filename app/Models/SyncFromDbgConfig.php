<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyncFromDbgConfig extends Model
{
    public $table = "sync_from_dbg_config";
    public $alias = "sfdc";

    protected $primaryKey = "ID";
}
