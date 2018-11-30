<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Log;
use Auth;

class NotificationController extends Controller
{
    

    public function checkNotify(Request $request){
        //Log::info('heel');
        $unRead = Notification::where('read','=','0')->select('from','data','id')->get();

        $user = $request->user;
        if ($user == 'accountant'){           
            $output ='';
            foreach ($unRead as $row){                         
                $output .= '<a class="dropdown-item" href="#" onclick="showNoti(\''.$row->data. '\',\''.$row->id.'\')">'.$row->data.'<br><small>'.$row->from.'</small></a>';
            }            
            echo $output;
        }
    }
  
    
}
