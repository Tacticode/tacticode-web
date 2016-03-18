<?php

namespace App\Http\Controllers;

use Auth;

use App\Http\Controllers\Controller;
use App\Http\Models\Character;
use App\Http\Models\Fight;

class FightsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => []]);
    }

    /**
     * Display the arena.
     *
     * @return \Illuminate\Http\Response
     */
    public function arena()
    {
        return view('arena.index');
    }


    /**
    * Display the visual of the fight.
    *
    * @var integer
    * @return \Illuminate\Http\Response
    */
    public function viewfight($fightId)
    {
        $fight = Fight::getFight($fightId);
        if ($fight == false)
        {
            return \Redirect::back()->withError(['error', trans('fights.doesNotExist')]);
        }

        //we pass the list of user character to show them differently
        $userCharactersIds = Auth::user()->character->lists('id');
        
        $data = compact('fight', 'userCharactersIds');

        return view('arena.viewFight', $data);
    }

    /**
    * Return a json with the content of the fight if the fight is over.
    *
    * @var integer
    * @return Json 
    */
    public function contentFight($fightId)
    {
        $fight = Fight::getFight($fightId);

        if ($fight != null && $fight->fight_content != null)
        {
            return response()->json(['content' => $fight->fight_content]);
        }
        return response()->json(['content' => null, 'description' => trans('arena.stillComputing')]);
    }

    /**
     * Display the characters to choose.
     *
     * @return \Illuminate\Http\Response
     */
    public function soloFight()
    {
        return view('arena.solofight', ['characters' => Auth::user()->character]);
    }

    /**
     * Create a solo fight.
     *
     * @return \Illuminate\Http\Response
     */
    public function launchSoloFight($characterId)
    {
        $character = Auth::user()->character->find($characterId);
        if ($character == null)
        {
            return \Redirect::back();
        }

        $opponent = Fight::getSoloRankedOpponent($character);
        if ($opponent == null)
        {
            return \Redirect::back()->withError(['error', trans('fights.noOpponent')]);
        }

        $character->visible = true;
        $character->save();

        $fight = Fight::create();
        $fight->character()->sync([$character->id, $opponent->id]);

        /* TEMPORAIRE EN ATTENTE DU SERVEUR DE COMBAT */
        \Storage::put('fights/'.$fight->id, '{"winner":'.(rand(0,1) != 0 ? $opponent->id : $character->id).'}');
        /* FIN DU TEMPORAIRE */

        return redirect('/arena/viewfight/' . $fight->id);
    }


    /**
     * Display the teams to choose.
     *
     * @return \Illuminate\Http\Response
     */
    public function teamFight()
    {
        return view('arena.teamfight', ['teams' => Auth::user()->team]);
    }

    /**
     * Create a team fight.
     *
     * @return \Illuminate\Http\Response
     */
    public function launchTeamFight($teamId)
    {
        $team = Auth::user()->team->find($teamId);
        if ($team == null)
        {
            return \Redirect::back();
        }

        $opponent = Fight::getTeamRankedOpponent($team);
        if ($opponent == null)
        {
            return \Redirect::back()->withError(['error', trans('fights.noOpponent')]);
        }

        $team->visible = true;
        $team->save();
        
        $fight = Fight::create();
        $fight->character()->attach($team->character->lists('id')->toArray(), ['team_id' => $team->id]);
        $fight->character()->attach($opponent->character->lists('id')->toArray(), ['team_id' => $opponent->id]);

        /* TEMPORAIRE EN ATTENTE DU SERVEUR DE COMBAT */
        \Storage::put('fights/'.$fight->id, '{"winner":'.(rand(0,1) != 0 ? $opponent->id : $team->id).'}');
        /* FIN DU TEMPORAIRE */

        return redirect('/arena/viewfight/' . $fight->id);
    }
}
