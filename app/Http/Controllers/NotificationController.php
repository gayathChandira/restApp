<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Log;
use Auth;

class NotificationController extends Controller
{
    // public function get(){
    //     $notification = Auth::user()->unreadNotifications;
        
    //     return $notification;

    // }
     
    // public function read(Request $request){
    //     Log::info($request);
    //     Auth::user()->unreadNotifications()->find($request->id)->markAsRead();
    //     return 'success';
    // }

    public function checkNotify(Request $request){
        Log::info('heel');
        $unRead = Notification::where('read','=','0')->select('from','data')->get();

        $user = $request->user;
        if ($user == 'accountant'){
            Log::info($unRead);
            $output ='';
            foreach ($unRead as $row){
                //$output =array('from'=>$row->from, 'data'=>$row->data);
                $output .= '<a class="dropdown-item" href="#">'.$row->data.'<br><small>'.$row->from.'</small></a>';
            }
            Log::info($output);
            echo $output;
        }
    }
}
