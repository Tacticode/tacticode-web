<?php

namespace App\Http\Controllers;

use App\Http\Models\Team;
use Auth;

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
        return view('teams.index', ['teams' => Auth::user()->team]);
    }

    /**
     * Show the specified team.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $team = Auth::user()->team->find($id);
        if ($team == null)
        {
            return redirect('/teams');
        }
        $datas = [
            'team' => $team,
            'characters' => $team->character
        ];

        return view('teams.view', $datas);
    }

    /**
     * Update the information of a team in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, TeamRequest $request)
    {
        $team = Auth::user()->team->find($id);
        if ($team == null)
        {
            return redirect('/team');
        }

        $req = $request->all();

        if ($req['name'] != $team->name)
            $team->name = $req['name'];
        $team->save();
        return redirect()->action('TeamsController@view', [$id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = ['characters' => Auth::user()->character->lists('name', 'id')->all()];
        $datas['characters'][0] = 'No character';
        ksort($datas['characters']);
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

        if (isset($req['characters'])) {

            $playersCharacters = Auth::user()->character->lists('id')->all();

            $characterIds = [];
            foreach ($req['characters'] as $character) {

                if ($character > 0 && !in_array($character, $characterIds) && in_array($character, $playersCharacters))
                    $characterIds[] = $character;
            }
            $team->character()->sync($characterIds);
        }

        return redirect('/teams');
    }
}
