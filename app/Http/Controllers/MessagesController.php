<?php

namespace App\Http\Controllers;

use App\Http\Models\User;
use App\Http\Models\Message;
use Auth;

use App\Http\Requests\MessageRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => []]);
    }

    /**
     * Display a list of the characters.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Auth::user()->message;
        return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('messages.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request)
    {
        $req = $request->all();
        
        $data = [
            'object' => $req['object'],
            'content' => $req['content']
        ];

        $message = Message::create($data);

        $tos = explode(', ', $req['to']);
        $users = [
            Auth::user()->id => [
                'type' => 1,
                'seen' => 1
            ]
        ];
        foreach ($tos as $to)
        {

            if ($to) {

                $user = User::where('login', '=', $to)->first();
                if ($user) {

                    $users[$user->id] = [
                        'type' => 0,
                        'seen' => 0
                    ];
                }
            }
        }
        $message->user()->sync($users);

        return redirect()->action('MessagesController@index');
    }

}
