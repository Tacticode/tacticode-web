<?php

namespace App\Http\Controllers;

use Auth;

use App\Http\Controllers\Controller;
use App\Http\Models\Character;
use App\Http\Models\Fight;
use App\Http\Models\Stat;
use App\Http\Models\Notification;

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
            return response()->json(['content' => json_decode($fight->fight_content)]);
        }
        return response()->json(['content' => null, 'description' => trans('arena.stillComputing')]);
    }

    /**
    * Add a character to the array for the Battle Engine
    */
    private function addCharacterToArray(&$arr, $char)
    {
        $stats = Stat::getMax();
        $spells = [];
        foreach ($char->node as $node)
        {
            if ($node->power != null && $node->power->spell == 1)
            {
                array_push($spells, $node->power->name);                
            }
        }
        $newEnt = [
            'id' => intval($char->id),
            'name' => $char->name,
            'breed' => $char->race->name,
            'health' => $stats['HP'],
            'attack' => $stats['STRENGTH'],
            'power' => $stats['INTELLIGENCE'],
            'defense' => $stats['DEFENCE'],
            'resilience' => $stats['RESILIENCE'],
            'luck' => $stats['LUCK'],
            'movement' => $stats['MOVEMENT'],
            'speed' => $stats['SPEED'],
            'spells' => $spells,
            'script' => ($char->script != null ? $char->script->content : ''),
            'position' => [0, 0]
        ];

        array_push($arr, $newEnt);
    }

    /**
    * Add a team to the array for the Battle Engine
    */
    private function addTeamToArray(&$arr, $char, $team)
    {
        $team_array = [
            'id' => intval($team === null ? $char->id : $team->id),
            'name' => ($team === null ? '' : $team->name),
            'characters' => []
        ];

        if ($team === null)
        {
            $this->addCharacterToArray($team_array['characters'], $char);
        }
        else
        {
            foreach ($char as $character)
            {
                $this->addCharacterToArray($team_array['characters'], $character);
            }
        }
        array_push($arr, $team_array);
    }

    /**
    * Take a Fight in parameter, create the Json and call the battle engine to launch the fight.
    *
    * @var \App\Http\Models\Fight
    */
    public function callBattleEngine($fight)
    {
        $maps = \Storage::allFiles('maps');
        $json = [
            'map' => json_decode(\Storage::get($maps[mt_rand(0, count($maps) - 1)])),
            'fightId' => $fight->id,
            'teams' => []
        ];

        $fighters = $fight->team()->groupBy('teams.id')->get();
        if (!$fighters->count())
        {
            $fighters = $fight->character;
            foreach ($fighters as $char)
            {
                $this->addTeamToArray($json['teams'], $char, null);
            }
        }
        else
        {
            foreach ($fighters as $team)
            {
                $this->addTeamToArray($json['teams'], $team->character, $team);
            }
        }

        /*echo json_encode($json);
        die;*/
        if (file_exists(Fight::getBattleEnginePath()))
        {
            $ba = popen(Fight::getBattleEnginePath() . ' > ' . storage_path() . '/app/fights/' . $fight->id . ' 2> ' . storage_path() . '/app/debug.txt', 'w');
            fwrite($ba, json_encode($json));
            pclose($ba);
        }
        else
        {
            $fighters = $fight->team()->groupBy('teams.id')->get();
            if (!$fighters->count())
            {
                $fighters = $fight->character;
            }
            $fake_result = [
                'map' => $json['map'],
                'winner' => (rand(0,1) != 0 ? $fighters[0]->id : $fighters[1]->id)
            ];
            \Storage::put('fights/'.$fight->id, json_encode($fake_result));
        }
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

        $notification = new notification;
        $notification->user_id = $opponent->user->id;
        $notification->seen = 0;
        $notification->title = \Lang::get('notifications.fight_solo_title');
        $notification->content = \Lang::get('notifications.fight_solo_content', ['character' => $opponent->name, 'enemy' => $character->name]);
        $notification->date = date('Y-m-d H:i:s');
        $notification->save();

        $this->callBattleEngine($fight);

        return redirect('/arena/viewfight/' . $fight->id);
    }


    /**
     * Display the teams to choose.
     *
     * @return \Illuminate\Http\Response
     */
    public function teamFight()
    {
        return view('arena.teamFight', ['teams' => Auth::user()->team]);
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

        $notification = new notification;
        $notification->user_id = $opponent->user->id;
        $notification->seen = 0;
        $notification->title = \Lang::get('notifications.fight_team_title');
        $notification->content = \Lang::get('notifications.fight_team_content', ['team' => $opponent->name, 'enemy' => $team->name]);
        $notification->date = date('Y-m-d H:i:s');
        $notification->save();

        $this->callBattleEngine($fight);

        return redirect('/arena/viewfight/' . $fight->id);
    }
}
