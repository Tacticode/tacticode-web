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
        return $this->belongsToMany('App\Http\Models\Fight', 'character_fight')->withTimestamps();
    }
}
