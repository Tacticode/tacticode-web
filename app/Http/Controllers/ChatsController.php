<?php

namespace App\Http\Controllers;

use App\Http\Models\User;
use App\Http\Models\Chat;
use Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ChatRequest;
use App\Http\Controllers\Controller;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => []]);
    }

    /**
     * Return the 20 last messages
     *
     * @return \Illuminate\Http\Response
     */
    public function lastMessages()
    {
        return response()->json(array_reverse(Chat::with('User')->orderBy('id', 'desc')->limit(20)->get()->toArray()));
    }

    /**
     * Return the message from $lastMessage
     *
     * @return \Illuminate\Http\Response
     */
    public function lastFrom($lastMessage)
    {
        return response()->json(Chat::with('User')->where('id', '>', $lastMessage)->get()->toArray());
    }

    /**
     * Write a message
     *
     * @return \Illuminate\Http\Response
     */
    public function write(ChatRequest $request, $lastMessage)
    {
        $req = $request->all();

        $data = [
            'message' => $req['message'],
            'user_id' => Auth::user()->id
        ];

        Chat::create($data);

        return redirect('/tactichat/lastfrom/' . $lastMessage);
    }
}
