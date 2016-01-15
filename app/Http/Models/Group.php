<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    public function user()
    {
    	return $this->hasMany('App\Http\Models\User');
    }
}
