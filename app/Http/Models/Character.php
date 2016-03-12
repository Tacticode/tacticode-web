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
        $datas = Character::find($id)->with(['fight' => function($query) {
            $query->where('team_id', null)->selectRaw('COUNT(CASE WHEN result = character_id then 1 ELSE NULL END) as win,
                COUNT(CASE WHEN result != character_id AND result IS NOT NULL AND result > 0 then 1 ELSE NULL END) as loss,
                COUNT(CASE WHEN result = 0 then 1 ELSE NULL END) as draw,
                COUNT(CASE WHEN result IS NULL then 1 ELSE NULL END) as pending');
        }])->first();

        $ret = [
            'win' => isset($datas->fight[0]) ? $datas->fight[0]->win : 0,
            'loss' => isset($datas->fight[0]) ? $datas->fight[0]->loss : 0,
            'draw' => isset($datas->fight[0]) ? $datas->fight[0]->draw : 0,
            'pending' => isset($datas->fight[0]) ? $datas->fight[0]->pending : 0
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
        $datas = Character::find($id)->with(['fight' => function($query) {
            $query->whereNotNull('team_id')->selectRaw('COUNT(CASE WHEN result = team_id then 1 ELSE NULL END) as win,
                COUNT(CASE WHEN result != team_id AND result IS NOT NULL AND result > 0 then 1 ELSE NULL END) as loss,
                COUNT(CASE WHEN result = 0 then 1 ELSE NULL END) as draw,
                COUNT(CASE WHEN result IS NULL then 1 ELSE NULL END) as pending');
        }])->first();

        $ret = [
            'win' => isset($datas->fight[0]) ? $datas->fight[0]->win : 0,
            'loss' => isset($datas->fight[0]) ? $datas->fight[0]->loss : 0,
            'draw' => isset($datas->fight[0]) ? $datas->fight[0]->draw : 0,
            'pending' => isset($datas->fight[0]) ? $datas->fight[0]->pending : 0
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
        $datas = Character::find($id)->with(['fight' => function($query) {
            $query->selectRaw('COUNT(CASE WHEN result IN(character_id, team_id) then 1 ELSE NULL END) as win,
                COUNT(CASE WHEN result NOT IN(character_id, team_id) AND result IS NOT NULL AND result > 0 then 1 ELSE NULL END) as loss,
                COUNT(CASE WHEN result = 0 then 1 ELSE NULL END) as draw,
                COUNT(CASE WHEN result IS NULL then 1 ELSE NULL END) as pending');
        }])->first();

        $ret = [
            'win' => isset($datas->fight[0]) ? $datas->fight[0]->win : 0,
            'loss' => isset($datas->fight[0]) ? $datas->fight[0]->loss : 0,
            'draw' => isset($datas->fight[0]) ? $datas->fight[0]->draw : 0,
            'pending' => isset($datas->fight[0]) ? $datas->fight[0]->pending : 0
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
