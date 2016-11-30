<?php

namespace App;

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
