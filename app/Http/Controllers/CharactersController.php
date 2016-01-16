<?php

namespace App\Http\Controllers;

use App\Http\Models\Character;
use App\Http\Models\User;
use App\Http\Models\Script;
use App\Http\Models\Classe;
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
        return view('characters.index', Auth::user()->character);
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
            'classes' => Classe::lists('name'),
            'scripts' => Auth::user()->script->lists('name'),
            'character' => $character
        ];

        return view('characters.view', $datas);
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
            'classes' => Classe::lists('name'),
            'scripts' => Auth::user()->script
        ];
        $datas['scripts'] = [0 => 'Aucun script'];
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
            'class_id' => $req['class'],
            'user_id' => Auth::user()->id,
            'script_id' => $req['script'] != 0 ? $req['script'] : null
        ];

        Character::create($data);

        return redirect('/characters');
    }
}
