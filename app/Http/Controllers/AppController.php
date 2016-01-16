<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AppController extends Controller
{
    public function index()
    {
    	if (Auth::check())
    	{
    		return redirect('/dashboard');
    	}
    	$error = \Session::get('error');
    	$fields = \Session::get('fields');
    	return view('welcome.welcome', compact('error', 'fields'));
    }
}
