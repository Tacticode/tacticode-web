<?php

namespace App\Http\Models;

use App\Http\Models\User;
use App\Http\Models\Race;
use App\Http\Models\Script;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'characters';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'race_id', 'script_id', 'user_id'];

    /**
    * A character belong to a user.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    *
    */
    public function user()
    {
        return $this->belongsTo('App\Http\Models\User');
    }

    /**
    * A character belong to a class.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    *
    */
    public function race()
    {
        return $this->belongsTo('App\Http\Models\Race');
    }

    /**
    * A character belong to a script.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasOne
    *
    */
    public function script()
    {
        return $this->belongsTo('App\Http\Models\Script');
    }

    /**
    * A character has many power.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    *
    */
    public function power()
    {
        return $this->hasMany('App\Http\Models\Script');
    }

    /**
    * A character has multiple nodes.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    *
    */
    public function node()
    {
        return $this->belongsToMany('App\Http\Models\Node')->withTimestamps();
    }

    /**
    * A character has multiple teams.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    *
    */
    public function team()
    {
        return $this->belongsToMany('App\Http\Models\Team')->withTimestamps();
    }

    /**
    * A character has many fights.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    *
    */
    public function fight()
    {
        return $this->belongsToMany('App\Http\Models\Fight')->withTimestamps();
    }
}
