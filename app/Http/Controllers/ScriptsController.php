<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Script;
use App\Http\Models\Character;
use Auth;

use App\Http\Requests\ScriptRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Flashes;

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
        $scripts = Auth::user()->script;
        foreach ($scripts as $script) {
            $script->nbLines = substr_count($script->content, "\n") + 1;
        }
        return view('scripts.index', ['scripts' => $scripts]);
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
     * Delete the specified script.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $script = Auth::user()->script->find($id);
        if ($script == null)
        {
            return redirect('/scripts');
        }

        Character::where('script_id', $id)->update(array('script_id' => null));
        $script->delete();
        Flashes::push('notice', trans('scripts.deleteSuccess'));
        return redirect('/scripts');
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
            $script->content = $req['content'];
        $script->save();
        Flashes::push('notice', trans('scripts.updated'));
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
            'content' => $req['content'],
            'user_id' => Auth::user()->id
        ];
        $id = Script::create($data)->id;

        return redirect()->action('ScriptsController@index', [$id]);
    }
}
