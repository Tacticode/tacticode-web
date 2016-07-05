<?php

namespace App\Http\Controllers\Tools;

use Auth;
use Flashes;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\Node;
use App\Http\Models\Power;
use App\Http\Models\Race;
use App\Http\Models\Path;

class NodeBuilderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => []]);
    }

    public function index()
    {
        if (Auth::user()->group->name != 'ADMIN')
        {
            Flashes::push('error', trans('administration.denied'));
            return \Redirect::back();
        }

    	return view('tools.nodebuilder', ['powers' => Power::all()]);
    }

    public function getTalentTree()
    {
        if (Auth::user()->group->name != 'ADMIN')
        {
            return response()->json(['result' => 'failure', 'description' => 'Access denied']);
        }

        return response()->json(['nodes' => Node::with('race', 'power')->get(), 'paths' => Path::all()]);
    }

    public function saveTalentTree(Request $request)
    {
        $req = $request->all();
        if (Auth::user()->group->name != 'ADMIN')
        {
            return response()->json(['result' => 'failure', 'description' => 'Access denied']);
        }
        $result = json_decode($req['tree']);
                
        if ($result == null)
        {
            return response()->json(['result' => 'failure', 'description' => 'Incorrect json']);
        }
        \DB::statement("SET foreign_key_checks=0");
        \DB::delete('DELETE FROM character_node WHERE node_id > 4');
        Node::truncate();
        Path::truncate();
        foreach ($result->nodes as $node)
        {
            $element = new node;
            $element->race_id = ($node->type == 'race' ? $node->powerId : null);
            $element->power_id = ($node->type == 'power' ? $node->powerId : null);
            $element->pos_x = $node->x;
            $element->pos_y = $node->y;
            $element->save();
        }
        foreach ($result->paths as $path)
        {
            $element = new path;
            $element->node_from = $path->node_from + 1;
            $element->node_to = $path->node_to + 1;
            $element->save();
        }
        \DB::statement("SET foreign_key_checks=1");
        return response()->json(['result' => 'success', 'description' => 'Database updated']);
    }
}
