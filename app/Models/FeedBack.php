<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedBack extends Model
{
    public $table = "feedback";
    public $alias = "fb";

    protected $primaryKey = "ID";
}
