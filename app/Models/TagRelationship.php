<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagRelationship extends Model
{
    public $table = "tag_relationshop";
    public $alias = "tr";

    protected $primaryKey = "ID";

    public function t()
    {
        return $this->belongsTo('App\Models\Tag', 'TagID', 'ID');
    }
}
