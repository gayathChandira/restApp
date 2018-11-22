<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Log;

class NotificationController extends Controller
{
    public function checknotify(){
        Log::info('khdf');
        $acc = Notification::where([['read','=','0'] ,['to','=','Accountant']])->get();
        $count = count($acc);
        Log::info($acc);
        Log::info($count);
        return view('accountant')->with('count',$count);
    }
}
