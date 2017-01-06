<?php

namespace App\Http\Controllers;

use App\Http\Models\User;
use App\Http\Models\Notification;
use Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => []]);
    }

    /**
     * Set the notif to seen.
     *
     * @return \Illuminate\Http\Response
     */
    public function see()
    {
        $notifications = Auth::User()->notification->where('seen', '0');

        foreach ($notifications as $notification)
            $notification->update(['seen' => 1]);

        return response()->json(['result' => 'success']);
    }

    /**
     * View all notifications
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $notifications = Auth::User()->notification;

        return view('notifications.all', compact(['notifications']));
    }
}
