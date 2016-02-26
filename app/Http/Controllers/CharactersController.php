<?php

namespace App\Http\Controllers;

use App\Http\Models\Character;
use App\Http\Models\User;
use App\Http\Models\Script;
use App\Http\Models\Race;
use App\Http\Models\Node;
use Auth;

use App\Http\Requests\CharacterRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CharactersController extends Controller
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
        return view('characters.index', ['characters' => Auth::user()->character]);
    }

    /**
     * Show the specified character.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $character = Auth::user()->character->find($id);
        if ($character == null)
        {
            return redirect('/characters');
        }
        $datas = [
            'races' => Race::lists('name', 'id'),
            'scripts' => Auth::user()->script->lists('name', 'id')->all(),
            'character' => $character
        ];
        $datas['scripts'][0] = 'Aucun script';
        ksort($datas['scripts']);

        return view('characters.view', $datas);
    }

    /**
     * Delete the specified character.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $character = Auth::user()->character->find($id);
        if ($character == null)
        {
            return redirect('/characters');
        }

        $character->delete();
        return redirect('/characters');
    }

    /**
     * Update the information of a character in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, CharacterRequest $request)
    {
        $character = Auth::user()->character->find($id);
        if ($character == null)
        {
            return redirect('/characters');
        }

        $req = $request->all();

        if ($req['name'] != $character->name)
            $character->name = $req['name'];
        if ($req['script'] != $character->script_id)
            $character->script_id = $req['script'] != 0 ? $req['script'] : null;
        $character->save();
        return redirect()->action('CharactersController@view', [$id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = [
            'races' => Race::lists('name', 'id'),
            'scripts' => Auth::user()->script->lists('name', 'id')->all()
        ];
        $datas['scripts'][0] = 'No script';
        ksort($datas['scripts']);
        return view('characters.add', $datas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CharacterRequest $request)
    {
        $req = $request->all();
        $data = [
            'name' => $req['name'],
            'race_id' => $req['race'],
            'user_id' => Auth::user()->id,
            'script_id' => $req['script'] != 0 ? $req['script'] : null
        ];

        $character = Character::create($data);

        $node = Node::where('race_id', $req['race'])->first();
        $character->node()->sync([$node->id]);

        return redirect('/characters');
    }
}
