<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function moments()
    {
        return $this->hasMany('App\Moment');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    public function messages()
    {
        return $this->hasManyThrough('App\Message', 'App\MessageReply');
    }

    public function itinerary()
    {
        return $this->hasMany('App\Itinerary');
    }
}