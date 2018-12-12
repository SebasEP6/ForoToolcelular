<?php

namespace Foro;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Messagable;
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'user', 'website_url',
                            'country', 'birthdate', 'slogan', 'sex', 'picture'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function posts()
    {

        return $this->hasMany('Foro\Post');

    }

    public function comments()
    {

        return $this->hasMany('Foro\Comment');

    }

    public function message_sent()
    {

        return $this->hasMany('Foro\Message');

    }

    public function message_receive()
    {

        return $this->hasMany('Foro\Message');

    }

    public function likes()
    {
        return $this->hasMany('Foro\Like');
    }

    public function quantity($total)
    {
        return count($total);
    }

    public function getAgeAttribute()
    {
        return \Carbon\Carbon::Parse($this->birthdate)->age;
    }

    public function setPasswordAttribute($value)
    {
        if (!empty($value))
        {
            $this->attributes['password'] = bcrypt($value);
        }
    }

}
