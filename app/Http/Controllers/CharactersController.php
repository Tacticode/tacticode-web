<?php

namespace App\Http\Controllers;

use App\Http\Models\Character;
use App\Http\Models\User;
use App\Http\Models\Script;
use App\Http\Models\Classe;
use Auth;

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
        return view('characters.view');
    }
}
