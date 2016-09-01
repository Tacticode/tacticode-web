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
    * Get the solo fight statistics of a specified character 
    *
    * @param integer
    *
    * @return array
    *
    */
    public static function getStats($id)
    {
        $win = count(Character::where('id', $id)->first()->fight()->withPivot('team_id')->where('team_id', null)->whereRaw('fights.result = character_fight.character_id')->groupBy('fights.id')->get());
        $loss = count(Character::where('id', $id)->first()->fight()->withPivot('team_id')->where('team_id', null)->whereRaw('fights.result != character_fight.character_id')->whereNotNull('result')->where('result', '>', 0)->groupBy('fights.id')->get());
        $draw = count(Character::where('id', $id)->first()->fight()->withPivot('team_id')->where('team_id', null)->where('result', 0)->groupBy('fights.id')->get());
        $pending = count(Character::where('id', $id)->first()->fight()->withPivot('team_id')->where('team_id', null)->where('result', null)->groupBy('fights.id')->get());
        $ret = [
            'win' => $win,
            'loss' => $loss,
            'draw' => $draw,
            'pending' => $pending
        ];
        return $ret;
    }

    /**
    * Get the team fight statistics of a specified character 
    *
    * @param integer
    *
    * @return array
    *
    */
    public static function getTeamStats($id)
    {
        $win = count(Character::where('id', $id)->first()->fight()->withPivot('team_id')->whereNotNull('team_id')->whereRaw('fights.result = character_fight.team_id')->groupBy('fights.id')->get());
        $loss = count(Character::where('id', $id)->first()->fight()->withPivot('team_id')->whereNotNull('team_id')->whereRaw('fights.result != character_fight.team_id')->whereNotNull('result')->where('result', '>', 0)->groupBy('fights.id')->get());
        $draw = count(Character::where('id', $id)->first()->fight()->withPivot('team_id')->whereNotNull('team_id')->where('result', 0)->groupBy('fights.id')->get());
        $pending = count(Character::where('id', $id)->first()->fight()->withPivot('team_id')->whereNotNull('team_id')->where('result', null)->groupBy('fights.id')->get());
        $ret = [
            'win' => $win,
            'loss' => $loss,
            'draw' => $draw,
            'pending' => $pending
        ];
        return $ret;
    }

    /**
    * Get the global fight statistics of a specified character 
    *
    * @param integer
    *
    * @return array
    *
    */
    public static function getGlobalStats($id)
    {
        $win = count(Character::where('id', $id)->first()->fight()->withPivot('team_id')->whereRaw('fights.result IN(character_fight.team_id, character_fight.team_id)')->groupBy('fights.id')->get());
        $loss = count(Character::where('id', $id)->first()->fight()->withPivot('team_id')->whereRaw('fights.result NOT IN(character_fight.team_id, character_fight.team_id)')->whereNotNull('result')->where('result', '>', 0)->groupBy('fights.id')->get());
        $draw = count(Character::where('id', $id)->first()->fight()->withPivot('team_id')->where('result', 0)->groupBy('fights.id')->get());
        $pending = count(Character::where('id', $id)->first()->fight()->withPivot('team_id')->where('result', null)->groupBy('fights.id')->get());
        $ret = [
            'win' => $win,
            'loss' => $loss,
            'draw' => $draw,
            'pending' => $pending
        ];
        return $ret;
    }

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
        return $this->belongsToMany('App\Http\Models\Fight')->where('team_id', null)->withTimestamps()->withPivot(['elo_change', 'elo_result']);
    }
}
