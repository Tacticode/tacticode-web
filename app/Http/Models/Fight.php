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
                
                $fight->result = $result->winner;
                $fight->fight_content = $content;

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
        $fight->result = $result->winner;
        $fight->fight_content = $content;

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
        //formula: https://metinmediamath.wordpress.com/2013/11/27/how-to-calculate-the-elo-rating-including-example/
        $fighters = $fight->team()->groupBy('id')->get();
        if (!$fighters->count())
        {
            $fighters = $fight->character;
        }

        $K = 32; // Based on chess. To chage if necessary
        $rating = [pow(10,($fighters[0]->elo / 400)), pow(10,($fighters[1]->elo / 400))];
        $score = [$rating[0] / ($rating[0] + $rating[1]), $rating[1] / ($rating[0] + $rating[1])];

        $elo1 = $fighters[0]->elo + $K * (($fight->result == 0 ? 0.5 : ($fight->result == $fighters[0]->id ? 1 : 0)) - $score[0]);
        $elo1 = ($elo1 < 0 ? 0 : $elo1);
        $elo2 = $fighters[1]->elo + $K * (($fight->result == 0 ? 0.5 : ($fight->result == $fighters[1]->id ? 1 : 0)) - $score[1]);
        $elo2 = ($elo2 < 0 ? 0 : $elo2);

        $fighters[0]->elo = $elo1;
        $fighters[0]->save();
        $fighters[1]->elo = $elo2;
        $fighters[1]->save();
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
        return $this->belongsToMany('App\Http\Models\Team', 'character_fight')->withTimestamps();
    }
}
