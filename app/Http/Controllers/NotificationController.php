<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Log;
use Auth;

class NotificationController extends Controller
{
    public function get(){
        $notification = Auth::user()->unreadNotifications;
        
        return $notification;

    }
     
    public function read(Request $request){
        Log::info($request);
        Auth::user()->unreadNotifications()->find($request->id)->markAsRead();
        return 'success';
    }
}
