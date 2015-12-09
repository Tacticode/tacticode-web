<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['login']]);
    }

    /**
     * Check the authentication of the user
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $data = $request->all();
        $data['remember_me'] = false;
        if (Auth::attempt(['login' => $data['login'], 'password' => $data['password']], $data['remember_me']))
        {
            return redirect()->intended('dashboard');
        }
        return \Redirect::to('/')
            ->with('error', "Login or password invalid.")
            ->with('fields', $data);
    }

    /**
     * Allow the user to logout
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
