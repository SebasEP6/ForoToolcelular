<?php

namespace Foro;

use Illuminate\Database\Eloquent\Model;

class MessengerParticipants extends Model
{
    protected $table = 'messenger_participants';

    protected $fillable = ['thread_id', 'user_id', 'last_read'];
}
