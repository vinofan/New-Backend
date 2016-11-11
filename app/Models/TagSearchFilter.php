<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagSearchFilter extends Model
{
    public $table = "tag_search_filter";
    public $alias = "tsf";

    protected $primaryKey = "TagId";

    public function t()
    {
        return $this->belongsTo('App\Models\Tag', 'TagId', 'ID');
    }
}
