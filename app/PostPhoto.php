<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostPhoto extends Model
{
	protected $fillable = ['post_id', 'filename'];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}