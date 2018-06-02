<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public $incrementing = false;
    protected $primarykey = ['user_id', 'content_id'];
    protected $fillable = ['user_id','content_id','rate'];
}
