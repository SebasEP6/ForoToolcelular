<?php

namespace Foro;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    protected $fillable = ['post_id', 'user_id'];

    public function Post()
    {
    	return $this->belongsTo('Foro\Post');
    }

    public function User()
    {
    	return $this->belongsTo('Foro\User');
    }
}
