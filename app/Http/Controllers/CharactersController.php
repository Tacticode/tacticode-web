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
        return view('characters.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $character = Auth::user()->character->where('id', $id)->first();
        if ($character == null)
        {
            return redirect('/characters');
        }
        $datas = [
            'classes' => Classe::all(),
            'scripts' => Auth::user()->script,
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
        return redirect()->action('CharactersController@view', [$id]);
    }
}
