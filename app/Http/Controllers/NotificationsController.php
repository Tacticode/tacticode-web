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
        $notifications = Auth::User()->notification;

        foreach ($notifications as $notification) {
            
            if ($notification->seen == 0)
                $notification->update(['seen' => 1]);
        }

        return response()->json(['result' => 'success']);
    }
}
