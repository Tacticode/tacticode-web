<?php

namespace App\Http\Controllers;

use App\Http\Models\User;
use App\Http\Models\Group;
use App\Http\Requests\CreateUserRequest;
use Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['create', 'store', 'login', 'loginexists', 'emailexists']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('welcome.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->all();
        $g = Group::where('name', 'like', 'USER')->firstOrFail();
        $data['group_id'] = $g->id;
        User::create($data);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::all();
        //return view(..., compact('users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        //return view(..., compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        //
        $user->save();
        //return redirect(...);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/');
    }

    /**
     * Check if a login exists in the database.
     *
     * @param string $login
     * @return A json containing the informations
     */
    public function loginexists($login)
    {
        $user = User::where('login', 'like', $login)->first();
        $res = var_export($user != null, true);
        return response()->json(['status' => 'ok', 'exists' => $res]);
    }

    /**
     * Check if an email exists in the database.
     *
     * @param string $email
     * @return A json containing the informations
     */
    public function emailexists($email)
    {
        $user = User::where('email', 'like', $email)->first();
        $res = var_export($user != null, true);
        return response()->json(['status' => 'ok', 'exists' => $res]);
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
