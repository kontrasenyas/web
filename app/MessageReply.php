<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageReply extends Model
{
    protected $table = 'message_reply';

    public function message()
    {
    	return $this->belongsTo('App\Message');
    }
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
