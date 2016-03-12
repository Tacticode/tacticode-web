<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Fight extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fights';

    /**
    * A fight has many characters.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    *
    */
    public function character()
    {
        return $this->belongsToMany('App\Http\Models\Character')->withTimestamps();
    }

    /**
    * A fight has many teams.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    *
    */
    public function team()
    {
        return $this->belongsToMany('App\Http\Models\Team', 'character_fight')->withTimestamps();
    }
}
