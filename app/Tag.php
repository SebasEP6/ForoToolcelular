<?php

namespace Foro;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $fillable = ['name'];

    public function posts()
    {
    	return $this->hasMany('Foro\Post');
    }
}
