<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
	protected $table = 'itinerary';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}