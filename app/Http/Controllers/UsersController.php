<?php

namespace App\Http\Controllers;

use App\Http\Models\User;
use App\Http\Models\Group;
use App\Http\Models\Fight;
use App\Http\Models\Notification;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Auth;
use Mail;

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
        $user = \Auth::user();
        $fights = Fight::select([
            'fights.id',
            'fights.result',
            'fights.created_at',
            'character_fight.elo_change'
        ])->userFights($user->id)->get()->all();
        $charactersIds = $user->character->lists('id')->all();

        $data = compact('user', 'fights', 'charactersIds');
        return view('dashboard', $data);
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
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $group = Group::where('name', 'like', 'USER')->firstOrFail();
        $data['group_id'] = $group->id;
        $user = User::create($data);

        $notification = new notification;
        $notification->user_id = $user->id;
        $notification->seen = 0;
        $notification->title = 'Welcome !';
        $notification->content = 'Welcome on the site';
        $notification->date = date('Y-m-d H:i:s');
        $notification->save();

        Mail::send('emails.inscription', ['user' => $user], function ($m) use ($user) {
            $m->from('no-reply@tacticode.net', 'Tacticode');

            $m->to($user->email, $user->login)->subject(\Lang::get('emails.inscription_subject'));
        });

        return redirect('/');
    }

    /**
     * Show the leaderboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function leaderboard()
    {
        $users = User::all();
        $elo = User::getElo();
        return view('leaderboard.index', compact('users', 'elo'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!($user = User::find($id)))
            return redirect('/');

        return view('user.view', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('user.index');
    }

    /**
     * Update the login and username in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request)
    {
        $user = Auth::user();
        $data = $request->all();

        if ($data['login'] != $user->login)
            $user->login = $data['login'];
        if ($data['email'] != $user->email)
            $user->email = $data['email'];
        $user->save();
        return redirect('/user');
    }

    /**
     * Update the password in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();
        $data = $request->all();
        
        $user->password = $data['new-password'];
        $user->save();
        return redirect('/user');
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
}
