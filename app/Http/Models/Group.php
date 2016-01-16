<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'groups';

    /**
    * A group has many users.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    *
    */
    public function user()
    {
    	return $this->hasMany('App\Http\Models\User');
    }
}
