<?php

namespace App\Http\Controllers;

use Auth;

use App\Http\Controllers\Controller;

class FightsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => []]);
    }

    /**
     * Display the arena.
     *
     * @return \Illuminate\Http\Response
     */
    public function arena()
    {
        return view('arena.index');
    }
}
