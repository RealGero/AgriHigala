<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function get(){
        $notifications = Auth::user()->unreadNotifications;

        return $notifications;
    }

    public function read(Request $request, $id){

        // MARK NOTIF AS READ
        Auth::user()->unreadNotifications()->find($id)->markAsRead();

        // CHECK IF URL IS AVAILABLE
        $action_url = $request->input('action_url');
        if ($action_url){
            return redirect($action_url);
        }
        else{
            return back();
        }
    }

    public function readAll(){
        
        Auth::user()->unreadNotifications()->update(['read_at' => now()]);
        return back();
    }
}
