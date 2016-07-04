<?php

namespace App\Http\Controllers;

use App\Http\Models\Character;
use App\Http\Models\Stat;
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
        return view('powers.manage', ['character' => $character, 'totalPowers' => Stat::getMax()['TALENT']]);
    }

    public function powersInfos($id) {

        $character = Auth::user()->character->find($id);
        if ($character == null)
        {
            return response()->json(['result' => 'failure', 'description' => trans('characters.doesNotBelongToTheUser')]);
        }

        return response()->json(['nodes' => Node::with('race', 'power')->get(), 'paths' => Path::all(), 'bought' => $character->node]);
    }

    public function buyNode(Request $request)
    {
        $req = $request->all();

        $character = Auth::user()->character->find($req['character_id']);
        if ($character == null)
        {
            return response()->json(['result' => 'failure', 'description' => trans('characters.doesNotBelongToTheUser')]);
        }

        $nodes = $character->node;
        if ($nodes->count() >= Stat::getMax()['TALENT'])
        {
            return response()->json(['result' => 'failure', 'description' => trans('powers.noTalentPointLeft')]);
        }

        $canBuy = false;
        foreach ($nodes as $n) {
            if ($n->id == $req['node_id'])
            {
                return response()->json(['result' => 'failure', 'description' => trans('powers.talentAlreadyAcquired')]);
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
            return response()->json(['result' => 'success', 'description' => trans('powers.nodeAddedToCharacter')]);
        }
        return response()->json(['result' => 'failure', 'description' => trans('powers.nodeCannotBeReached')]);
    }

    private function checkPathStart($node, $nodes_id)
    {
        if ($node->race_id != null)
        {
            return true;
        }
        foreach (Node::getAdjacentNodes($node) as $adj_node)
        {
            if (in_array($adj_node->id, $nodes_id))
            {
                return $this->checkPathStart($adj_node, array_diff($nodes_id, [$adj_node->id]));
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
            return response()->json(['result' => 'failure', 'description' => trans('characters.doesNotBelongToTheUser')]);
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
            return response()->json(['result' => 'failure', 'description' => trans('powers.nodeDoesNotBelongToTheCharacter')]);            
        }

        foreach (Node::getAdjacentNodes($node_start) as $adj_node)
        {
            if (in_array($adj_node->id, $nodes_id) && !$this->checkPathStart($adj_node, array_diff($nodes_id, [$adj_node->id])))
            {
                return response()->json(['result' => 'failure', 'description' => trans('powers.nodeIsNotAtTheEnd')]);
            }
        }
        $character->node()->detach([$req['node_id']]);
        return response()->json(['result' => 'success', 'description' => trans('powers.nodeRemovedFromCharacter')]);
    }

    public function resetPower(Request $request)
    {
        $req = $request->all();

        $character = Auth::user()->character->find($req['character_id']);
        if ($character == null)
        {
            return response()->json(['result' => 'failure', 'description' => trans('characters.doesNotBelongToTheUser')]);
        }

        $start = Node::where('race_id', $character->race->id)->first();
        $character->node()->sync([$start->id]);
        return response()->json(['result' => 'success', 'description' => trans('powers.powersResetted')]);
    }
}
