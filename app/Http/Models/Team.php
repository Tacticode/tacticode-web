<?php

namespace App\Http\Models;

use App\Http\Models\User;
use App\Http\Models\Race;
use App\Http\Models\Script;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teams';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'user_id'];

    /**
    * Get the fight statistics of a specified team 
    *
    * @param integer
    *
    * @return array
    *
    */
    public static function getStats($id)
    {
        $win = count(Team::where('id', $id)->first()->fight()->withPivot('team_id')->whereRaw('fights.result = character_fight.team_id')->groupBy('fights.id')->get());
        $loss = count(Team::where('id', $id)->first()->fight()->withPivot('team_id')->whereRaw('fights.result != character_fight.team_id')->whereNotNull('result')->where('result', '>', 0)->groupBy('fights.id')->get());
        $draw = count(Team::where('id', $id)->first()->fight()->withPivot('team_id')->where('result', 0)->groupBy('fights.id')->get());
        $pending = count(Team::where('id', $id)->first()->fight()->withPivot('team_id')->where('result', null)->groupBy('fights.id')->get());
        $ret = [
            'win' => $win,
            'loss' => $loss,
            'draw' => $draw,
            'pending' => $pending
        ];
        return $ret;
    }

    /**
    * A team belong to a user.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    *
    */
    public function user()
    {
        return $this->belongsTo('App\Http\Models\User');
    }

    /**
    * A team has multiple characters.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    *
    */
    public function character()
    {
        return $this->belongsToMany('App\Http\Models\Character')->withTimestamps();
    }

    /**
    * A team has many fights.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    *
    */
    public function fight()
    {
        return $this->belongsToMany('App\Http\Models\Fight', 'character_fight')->withTimestamps()->withPivot(['elo_change', 'elo_result'])->groupBy('fights.id');
    }
}
