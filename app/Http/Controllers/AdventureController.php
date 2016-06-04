<?php

namespace App\Http\Controllers;

use Auth;

use App\Http\Models\Dungeon;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdventureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => []]);
    }

    /**
     * Display the adventure mode index page
     *
     * @return \Illuminate\Http\Response
     */
    function index()
    {
    	return view('adventure.index');
    }

    /**
     * Display the tacticode basic dungeons
     *
     * @return \Illuminate\Http\Response
     */
    function dungeons()
    {
    	$dungeons = Dungeon::whereNotNull('official')->orderBy('official', 'asc')->get();

    	return view('adventure.dungeons', compact('dungeons'));
    }

    /**
     * Index of the custom dungeons
     *
     * @return \Illuminate\Http\Response
     */
    function customDungeons()
    {
		$dungeons = Dungeon::where('official', null)->orderBy('rating', 'desc')->get();

    	return view('adventure.customDungeons', compact('dungeons'));
    }

    /**
     * Return a json containin the search results
     *
     * @return json
     */
    function searchDungeons()
    {
    	return response()->json(['dungeons' => '']);
    }
}
