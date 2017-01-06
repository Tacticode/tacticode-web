<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Character;
use App\Http\Models\Team;

class Fight extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fights';

    /**
    * Return the BATTLE_ENGINE environement variable or kill the process if it is not set
    *
    * @return String
    */
    public static function getBattleEnginePath()
    {
        if (env('BATTLE_ENGINE') == '')
        {
            dd('Error: Can not call the battle engine: Variable BATTLE_ENGINE not set.');            
        }
        return (env('BATTLE_ENGINE'));
    }

    /**
    * Allow to transfer all pending fights into the bdd.
    */
    public static function pendingFights()
    {
        $files = \Storage::files('fights');

        foreach ($files as $file)
        {
            $fight = Fight::find(intval(basename($file)));
            if ($fight != null)
            {
                $content = \Storage::get($file);
                $result = json_decode($content);
                
                if ($result == null)
                {
                    dd('Invalid json');
                }
                else
                {
                    $fight->result = $result->winner;
                    $fight->fight_content = $content;
                }

                if ($fight->save())
                {
                    \Storage::delete($file);
                    Fight::computeElo($fight);
                }
            }
        }
    }

    /**
    * Attempt to get a fight in the bdd. If the fight is not over, try to search for the fight file.
    * Return null if none of the above works.
    *
    * @var integer
    * @return \Illuminate\Database\Eloquent\...
    */
    public static function getFight($id)
    {
        $fight = Fight::find($id);

        if ($fight == null)
        {
            return false;
        }
        if ($fight->result != null)
        {
            return $fight;
        }

        $file = "fights/".$id;
        if (!\Storage::exists($file))
        {
            return $fight;
        }
        $content = \Storage::get($file);

        $result = json_decode($content);

        if ($result == null)
        {
            dd('Invalid json');
        }
        else
        {
            // As the winner of the battle engine is not valid at the moment, there is no winner if the output fight is from the battle engine
            $fight->result = $result->winner;//(file_exists(Fight::getBattleEnginePath()) ? 0 : $result->winner);
            $fight->fight_content = $content;
        }

        if ($fight->save())
        {
            \Storage::delete($file);
            Fight::computeElo($fight);
            return $fight;
        }
        return null;
    }

    /**
    * Calculate the variation of elo of the fighters
    *
    * @var \App\Models\Fight
    */
    public static function computeElo($fight)
    {
        if ($fight->type != 0)
            return ;
        //formula: https://metinmediamath.wordpress.com/2013/11/27/how-to-calculate-the-elo-rating-including-example/
        $fighters = $fight->team()->groupBy('teams.id')->get();
        if (!$fighters->count())
        {
            $fighters = $fight->character;
        }

        $K = 32; // Based on chess. To change if necessary
        $rating = [pow(10,($fighters[0]->elo / 400)), pow(10,($fighters[1]->elo / 400))];

        for ($i = 0; $i < 2; ++$i)
        {
            $score = $rating[$i] / ($rating[0] + $rating[1]);
            $elo = round($K * (($fight->result == 0 ? 0.5 : ($fight->result == $fighters[$i]->id ? 1 : 0)) - $score));
            if ($fighters[$i]->elo + $elo < 0)
            {
                $elo = -$fighters[$i]->elo;                
            }
            $fighters[$i]->elo += $elo;
            $fighters[$i]->fight()->updateExistingPivot($fight->id, ['elo_change' => $elo, 'elo_result' => $fighters[$i]->elo]);
            $fighters[$i]->save();
        }
    }

    /**
    * Find an appropriate solo opponent based on elo
    *
    * @var \App\Models\Character
    * @return \App\Models\Character
    */
    public static function getSoloRankedOpponent($character)
    {
        $range = [$character->elo - 50 < 0 ? 0 : $character->elo - 50, $character->elo + 50];
        $fighters = Character::where('id', '!=', $character->id)
        ->where('visible', true)
        ->where('user_id', '!=', $character->user_id)
        ->whereBetween('elo', $range)->get();

        if ($fighters->count())
        {
            return $fighters->shuffle()->first();
        }

        $opponent = Character::where('id', '!=', $character->id)
        ->where('visible', true)
        ->where('user_id', '!=', $character->user_id)
        ->orderBy(\DB::raw('ABS(elo - '.$character->elo.')'), 'ASC')->first();

        return $opponent;
    }

    /**
    * Find an appropriate team opponent based on elo
    *
    * @var \App\Models\Team
    * @return \App\Models\Team
    */
    public static function getTeamRankedOpponent($team)
    {
        $range = [$team->elo - 50 < 0 ? 0 : $team->elo - 50, $team->elo + 50];
        $fighters = Team::where('id', '!=', $team->id)
        ->where('visible', true)
        ->where('user_id', '!=', $team->user_id)
        ->whereBetween('elo', $range)->get();

        if ($fighters->count())
        {
            return $fighters->shuffle()->first();
        }

        $opponent = Team::where('id', '!=', $team->id)
        ->where('visible', true)
        ->where('user_id', '!=', $team->user_id)
        ->orderBy(\DB::raw('ABS(elo - '.$team->elo.')'), 'ASC')->first();
        
        return $opponent;
    }

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
        return $this->belongsToMany('App\Http\Models\Team', 'character_fight')->withTimestamps()->groupBy('team_id');
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
