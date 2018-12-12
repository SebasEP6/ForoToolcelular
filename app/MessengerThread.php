<?php

namespace Foro;

use Illuminate\Database\Eloquent\Model;

class MessengerThread extends Model
{
    protected $table = 'messenger_threads';

    protected $fillable = ['subject'];
}
