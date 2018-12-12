<?php

namespace Foro;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $table = 'messages';

    protected $fillable = ['message', 'sent_id', 'receive_id'];

    public function sent()
    {

    	return $this->belongsTo('Foro\User');

    }

    public function receive()
    {

    	return $this->belongsTo('Foro\User');

    }

}
