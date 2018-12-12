<?php

namespace Foro;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $table = 'comments';

    protected $fillable = ['comment', 'user_id'];

    public function post()
    {

    	return $this->belongsTo('Foro\Post');

    }

    public function user()
    {

    	return $this->belongsTo('Foro\User');

    }

}
