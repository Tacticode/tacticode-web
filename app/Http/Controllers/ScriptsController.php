<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Http\Requests\ScriptRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ScriptsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => []]);
    }
    
    /**
     * Display a list of the scripts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('scripts.index');
    }

    /**
     * Show the specified script.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $script = Auth::user()->script->find($id);
        if ($script == null)
        {
            return redirect('/scripts');
        }

        return view('scripts.view', ['script' => $script]);
    }

    /**
     * Update the information of a script in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, ScriptRequest $request)
    {
        $script = Auth::user()->script->find($id);
        if ($script == null)
        {
            return redirect('/scripts');
        }

        $req = $request->all();

        if ($req['name'] != $script->name)
            $script->name = $req['name'];
        if ($req['content'] != $script->content)
            $script->script_id = $req['content'];
        $script->save();
        return redirect()->action('ScriptsController@view', [$id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('scripts.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScriptRequest $request)
    {
        $req = $request->all();
        $data = [
            'name' => $req['name'],
            'content' => '',
            'user_id' => Auth::user()->id
        ];
        $id = Script::create($data)->id;

        return redirect()->action('ScriptsController@view', [$id]);
    }
}
