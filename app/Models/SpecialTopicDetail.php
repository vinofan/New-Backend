<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialTopicDetail extends Model
{
    public $table = "special_topic_detail";
    public $alias = "std";

    protected $primaryKey = "ID";

    public function st()
    {
        return $this->belongsTo('App\Models\SpecialTopic', 'TopicID', 'ID');
    }
}
