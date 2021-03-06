<?php

namespace App\Http\Controllers;

use App\Http\Models\Team;
use Auth;
use Flashes;

use App\Http\Requests\TeamRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TeamsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => []]);
    }

    /**
     * Display a list of the characters.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Auth::user()->team;
        foreach ($teams as &$team) {
            $team->stats = Team::getStats($team->id);
        }
        return view('teams.index', compact('teams'));
    }

    /**
     * Show the specified team.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        if (!($team = Team::find($id)))
        {
            Flashes::push('error', trans('teams.doesNotExist'));
            return redirect('/teams');            
        }

        $datas = [
            'team' => $team,
            'characters' => Auth::user()->character->pluck('name', 'id')->all()
        ];

        if (Auth::user()->team->find($id))
            return view('teams.view', $datas);
        else
            return view('teams.access', $datas);
    }

    /**
     * Update the information of a team in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, TeamRequest $request)
    {
        if (!($team = Auth::user()->team->find($id)))
            return redirect('/teams');

        $req = $request->all();

        if ($req['name'] != $team->name)
            $team->name = $req['name'];

        if (isset($req['characters']))
        {

            $playersCharacters = Auth::user()->character->pluck('id')->all();

            $characterIds = [];
            foreach ($req['characters'] as $character)
            {

                if ($character > 0 && !in_array($character, $characterIds) && in_array($character, $playersCharacters))
                    $characterIds[] = $character;
            }
            $team->character()->sync($characterIds);
        }
        else
        {
            $team->character()->detach();
        }

        $team->save();
        Flashes::push('notice', trans('teams.updateSuccess'));
        return redirect()->action('TeamsController@index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = ['characters' => Auth::user()->character->pluck('name', 'id')->all()];
        return view('teams.add', $datas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamRequest $request)
    {
        $req = $request->all();
        $data = [
            'name' => $req['name'],
            'user_id' => Auth::user()->id
        ];

        $team = Team::create($data);

        if (isset($req['characters']))
        {

            $playersCharacters = Auth::user()->character->pluck('id')->all();

            $characterIds = [];
            foreach ($req['characters'] as $character)
            {

                if ($character > 0 && !in_array($character, $characterIds) && in_array($character, $playersCharacters))
                    $characterIds[] = $character;
            }
            $team->character()->sync($characterIds);
        }

        Flashes::push('notice', trans('teams.addSuccess'));
        return redirect('/teams');
    }

    /**
     * Delete the specified team.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (!($team = Auth::user()->team->find($id)))
            return redirect('/teams');

        $team->character()->detach();
        $team->delete();

        Flashes::push('notice', trans('teams.deleteSuccess'));
        return redirect('/teams');
    }

    /**
     * Set the visibility of a team
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function setVisibility(Request $request)
    {
        $req = $request->all();
        if (!isset($req['team_id']))
        {
            return response()->json(['result' => 'failure', 'description' => trans('teams.noTeamId')]);
        }
        $team = Auth::user()->team->find($req['team_id']);
        if ($team == null)
        {
            return response()->json(['result' => 'failure', 'description' => trans('teams.doesNotBelongToTheUser')]);
        }

        if (!isset($req['visibility']))
        {
            return response()->json(['result' => 'failure', 'description' => trans('characters.noVisibility')]);
        }
        $team->visible = $req['visibility'];
        $team->save();
        
        return response()->json(['result' => 'success']);
    }
}
