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
            return response()->json(['result' => 'failure', 'description' => 'The character does not belong to the user.']);
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

        $canBuy = false;
        foreach ($nodes as $n) {
            if ($n->id == $req['node_id'])
            {
                return response()->json(['result' => 'failure', 'description' => 'Talent already acquired.']);
            }
            foreach (Node::getAdjacentNodes($n) as $adj_node)
            {
                if ($adj_node->id == $req['node_id'] && $adj_node->race_id == null)
                {
                    $canBuy = true;
                }
            }
        }
        if ($canBuy)
        {
            $character->node()->attach([$req['node_id']]);
            return response()->json(['result' => 'success', 'description' => 'Node added to character.']);
        }
        return response()->json(['result' => 'failure', 'description' => 'Node cannot be reached.']);
    }

    private function checkPathStart($node, $nodes_id)
    {
        foreach (Node::getAdjacentNodes($node) as $adj_node)
        {
            if (in_array($nodes_id, $adj_node->id))
            {
                if ($adj_node->race_id != null)
                {
                    return true;
                }
                return checkPathStart($adj_node, array_diff($nodes_id, [$adj_node->id]));
            }
        }
        return false;
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
        $nodes_id = [];
        $node_start = null;
        foreach ($nodes as $n)
        {
            if ($n->id == $req['node_id'] && $n->race_id == null)
            {
                $node_start = $n;
            }
            else
            {
                $nodes_id[] = $n->id;
            }
        }
        if ($node_start == null)
        {
            return response()->json(['result' => 'failure', 'description' => 'Node does not belong to the character.']);            
        }

        foreach (Node::getAdjacentNodes($node_start) as $adj_node)
        {
            if (!checkPathStart($adj_node, $nodes_id))
            {
                return response()->json(['result' => 'failure', 'description' => 'Node is not at the end.']);
            }
        }
        $character->node()->detach([$req['node_id']]);
        return response()->json(['result' => 'success', 'description' => 'Node removed from character.']);
    }

    public function resetPower(Request $request)
    {
        $req = $request->all();

        $character = Auth::user()->character->find($req['character_id']);
        if ($character == null)
        {
            return response()->json(['result' => 'failure', 'description' => 'The character does not belong to the user.']);
        }

        $start = Node::where('race_id', $character->race->id)->first();
        $character->node()->sync([$start->id]);
        return response()->json(['result' => 'success', 'description' => 'Powers resetted.']);
    }
}
