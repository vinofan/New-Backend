<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $table = "tag";
    public $alias = "t";

    protected $primaryKey = "ID";

    public function rct()
    {
        return $this->hasMany('App\Models\RCouponTag', 'TagID', 'ID');
    }
}
