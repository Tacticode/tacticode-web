<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tutorials';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'message'];

    /**
    * A tutorial has many users.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    *
    */
    public function user()
    {
    	return $this->hasMany('App\Http\Models\User');
    }
}
