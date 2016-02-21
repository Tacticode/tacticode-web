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

        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());

        return view('powers.manage', ['character' => $character, 'token' => $encrypted_token]);
    }

    public function powersInfos($id) {

        $character = Auth::user()->character->find($id);
        if ($character == null)
        {
            return redirect('/characters');
        }

        return response()->json(['nodes' => Node::with('race', 'power')->get(), 'paths' => Path::all(), 'bought' => $character->node]);
    }

    public function buyNode(Request $request)
    {
        $req = $request->all();

        $character = Auth::user()->character->find($req['character_id']);
        if ($character == null)
        {
            return response()->json(['result' => 'failure', 'description' => 'The character does not belong to the user.']);
        }

        $nodes = $character->node;
        if ($nodes->count() >= 8)
        {
            return response()->json(['result' => 'failure', 'description' => 'No talent point left.']);
        }

        $connected = false;
        foreach ($nodes as $n) {
            if ($n->id == $req['node_id'])
            {
                return response()->json(['result' => 'failure', 'description' => 'Talent already acquired.']);
            }
            foreach ($n->path_from as $p) {
                $nt = $p->node_t;
                if ($nt->id == $req['node_id'] && $nt->race_id == null)
                {
                    $connected = true;
                }
            }
            foreach ($n->path_to as $p) {
                $nf = $p->node_f;
                if ($nf->id == $req['node_id'] && $nf->race_id == null)
                {
                    $connected = true;
                }
            }
            if ($connected)
            {
                $character->node()->attach([$req['node_id']]);
                return response()->json(['result' => 'success', 'description' => 'Node added to character.']);
            }
        }
        return response()->json(['result' => 'failure', 'description' => 'Node cannot be reached.']);
    }

    public function sellNode(Request $request)
    {
        $req = $request->all();

        $character = Auth::user()->character->find($req['character_id']);
        if ($character == null)
        {
            return response()->json(['result' => 'failure', 'description' => 'The character does not belong to the user.']);
        }

        $nodes = $character->node;
        $nodes_id = array();
        foreach ($nodes as $n)
        {
            array_push($nodes_id, $n->id);
        }

        foreach ($nodes as $n) {
            if ($n->id == $req['node_id'] && $n->race_id == null)
            {
                $character->node()->detach([$req['node_id']]);
                return response()->json(['result' => 'success', 'description' => 'Node removed from character.']);
            }
        }
        return response()->json(['result' => 'failure', 'description' => 'Node does not belong to the character.']);
    }
}
