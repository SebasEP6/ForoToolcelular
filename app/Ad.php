<?php

namespace Foro;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    public function getDateAttribute()
    {
    	return \Carbon\Carbon::Parse($this->created_at)->format('d-m-Y');
    }
}
