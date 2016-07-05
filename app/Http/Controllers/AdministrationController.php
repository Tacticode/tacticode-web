<?php

namespace App\Http\Controllers;

use Auth;

use App\Http\Models\User;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdministrationController extends Controller
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
        $users = User::all();
        return view('administration.index', compact('users'));
    }

    public function logAs($id)
    {
        if (Auth::user()->group->name != 'ADMIN')
        {
            Flashes::push('error', trans('administration.denied'));
            return \Redirect::back();
        }
        if (\Session::get('loggedFrom', -1) == -1)
        {
            \Session::set('loggedFrom', Auth::user()->id);            
        }
        Auth::loginUsingId($id);
        return redirect('dashboard');
    }

    public function logBack()
    {
        $id = \Session::get('loggedFrom', -1);
        if ($id > -1)
        {
            Auth::loginUsingId($id);
        }
        \Session::set('loggedFrom', -1);
        return redirect('/administration');
    }

    public function bann($id)
    {
        if (Auth::user()->group->name != 'ADMIN')
        {
            Flashes::push('error', trans('administration.denied'));
            return \Redirect::back();
        }
        if ($id != Auth::user()->id)
        {
            $user = User::findOrFail($id);
            $user->banned = true;
            $user->save();
        }
        return \Redirect::back();
    }

    public function unbann($id)
    {
        if (Auth::user()->group->name != 'ADMIN')
        {
            Flashes::push('error', trans('administration.denied'));
            return \Redirect::back();
        }
        $user = User::findOrFail($id);
        $user->banned = false;
        $user->save();
        return \Redirect::back();
    }
}
