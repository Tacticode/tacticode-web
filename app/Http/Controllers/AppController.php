<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AppController extends Controller
{
    public function index()
    {
    	$error = \Session::get('error');
    	$fields = \Session::get('fields');
    	return view('welcome.welcome', compact('error', 'fields'));
    }
}
