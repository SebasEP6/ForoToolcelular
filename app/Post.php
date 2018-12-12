<?php

namespace Foro;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';

    protected $fillable = ['title', 'body', 'category_id',
    						'type', 'name', 'path'];

    public function category()
    {

    	return $this->belongsTo('Foro\Category');

    }

    public function comments()
    {

    	return $this->hasMany('Foro\Comment');

    }

    public function user()
    {

    	return $this->belongsTo('Foro\User');

    }

    public function likes()
    {
        return $this->hasMany('Foro\Like');
    }

    public function tags()
    {
        return $this->belongsToMany('Foro\Tag');
    }

    public function quantity($total)
    {

        return count($total);

    }

    public function isPopular($total)
    {
        if (count($total) > 5)
        {
            return 'glyphicon glyphicon-star';
        }
        else
        {
            return 'glyphicon glyphicon-star-empty';
        }
    }

    public function icon($type)
    {
        switch($type)
        {
            case 'software':
                return 'glyphicon glyphicon-floppy-disk';
                break;
            default:
                return 'glyphicon glyphicon-wrench';
        }
    }

}
