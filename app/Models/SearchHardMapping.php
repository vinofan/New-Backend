<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchHardMapping extends Model
{
    public $table = "search_hardmapping";
    public $alias = "shm";

    protected $primaryKey = "ID";

    public function nm()
    {
        return $this->belongsTo('App\Models\NormalMerchant', 'ObjID', 'ID');
    }
}
