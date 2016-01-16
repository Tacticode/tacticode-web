<?php

namespace App\Http\Models;

use App\Http\Models\Character;

use Illuminate\Database\Eloquent\Model;

class Script extends Model
{
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'scripts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'content', 'user_id'];

    /**
    * A script belongs to a user.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    *
    */
    public function user()
    {
        return $this->belongsTo('App\Http\Models\User');
    }

    /**
    * A script has many character.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    *
    */
    public function character()
    {
        return $this->hasMany('App\Http\Models\Character');
    }
}
