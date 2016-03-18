<?php

namespace App\Http\Controllers;

use Auth;

use App\Http\Controllers\Controller;

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

    public function viewfight($fightId) {

        //we get the fight
        $fight = [
            'id' => 1,
            'result' => null,
            'fight_content' => null,
            'characters' => [
                ['name' => 'toto', 'team_id' => null, 'id' => 42],
                ['name' => 'pinpin', 'team_id' => null, 'id' => 1]
            ]
        ];

        //if the fight has no results, we check and maybe update it

        //we pass the list of user character to show them differently
        $userCharactersIds = Auth::user()->character->lists('id');
        
        $data = compact('fight', 'userCharactersIds');

        return view('arena.viewFight', $data);
    }

    public function contentFight($fightId) {

        //checking if the fight is finished

        if (1)
            return response()->json(['content' => 'euh..']);

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

        //find the opponent
        $opponent = $character;
        if ($opponent == null)
        {
            return \Redirect::back()->withError(['error', trans('fights.noOpponent')]);
        }

        //create the battle in database
        $fightId = 1;

        return redirect('/arena/viewfight/' . $fightId);
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

        //find the opponent
        $opponent = $team;
        if ($opponent == null)
        {
            return \Redirect::back()->withError(['error', trans('fights.noOpponent')]);
        }

        //create the battle in database
        $fightId = 1;

        return redirect('/arena/viewfight/' . $fightId);
    }
}
