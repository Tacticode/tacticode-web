<?php

namespace App\Http\Controllers;

use App\Http\Models\Character;
use App\Http\Models\Node;
use App\Http\Models\Power;
use App\Http\Models\Race;
use App\Http\Models\Path;
use Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PowersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => []]);
    }

    public function view($id)
    {
        $character = Auth::user()->character->find($id);
        if ($character == null)
        {
            return redirect('/characters');
        }

        return view('powers.manage', ['character' => $character, 'nodes' => Node::all()]);
    }

    public function buyNode(Request $request)
    {

    }

    public function sellNode(Request $request)
    {

    }
}
