<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialTopic extends Model
{
    public $table = "special_topic";
    public $alias = "st";

    protected $primaryKey = "ID";

    public function t()
    {
        return $this->belongsTo('App\Models\Tag', 'TagId', 'ID');
    }
}
