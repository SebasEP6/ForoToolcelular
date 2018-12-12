<?php

namespace Foro;

use Illuminate\Database\Eloquent\Model;

class MessengerMessage extends Model
{
    protected $table = 'messenger_messages';

    protected $fillable = ['thread_id', 'user_id', 'body'];
}
