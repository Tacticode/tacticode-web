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

    /**
    * Get all the fight of a users
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    *
    */
    public function scopeUserFights($query, $userId)
    {
        return $query->join('character_fight', 'character_fight.fight_id', '=', 'fights.id')
                    ->join('characters', 'character_fight.character_id', '=', 'characters.id')
                    ->join('users', 'users.id', '=', 'characters.user_id')
                    ->where('users.id', '=', $userId)
                    ->groupBy('fights.id');
    }
}
