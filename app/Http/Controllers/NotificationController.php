<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Log;
use Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function checkNotify(Request $request){
 
        
        $user = $request->user;
        if ($user == 'accountant'){ 
            $accountant = Notification::where('read','=','0')->where('to','=','Accountant')->select('to','from','data','id')->get();
            $accountcount = Notification::where('read','=','0')->where('to','=','Accountant')->select('to','from','data','id')->count();
           
            if ($accountant->isEmpty()){
                $output =''; 
                $output .= '<a class="dropdown-item" style="text-align:center" href="#">No New Notifications</a>';
                echo $output;
            }
            else{                        
                      
                    foreach ($accountant as $row){   
                        $output ='';                                      
                        $output .= '<a class="dropdown-item" href="#" onclick="showNoti(\''.$row->data. '\',\''.$row->id.'\')">'.$row->data.'<br><small>'.$row->from.'</small></a>
                        <input type="hidden" id="count" value="'.$accountcount.'">';
                        echo $output;                            
                    }
            }
        }
        





        if ($user == 'inventory manager'){ 
            $inventoryManager = Notification::where('read','=','0')->where('to','=','Inventory Manager')->select('to','from','data','id')->get();
            $inventorycount = Notification::where('read','=','0')->where('to','=','Inventory Manager')->select('to','from','data','id')->count();
           
            if ($inventoryManager->isEmpty()){
                $output =''; 
                $output .= '<a class="dropdown-item" style="text-align:center" href="#">No New Notifications</a>';
                echo $output;
            }
            else{                       
                     
                    foreach ($inventoryManager as $row){ 
                        
                        
                        $output ='';                                           
                        $output .= '<a class="dropdown-item" href="#" onclick="showNoti(\''.$row->data. '\',\''.$row->id.'\')">'.$row->data.'<br><small>'.$row->from.'</small></a>
                        <input type="hidden" id="count" value="'.$inventorycount.'">';
                        
                        echo $output;
                    }         
                
            }
        }

        if ($user == 'admin'){ 
            $admin = Notification::where('read','=','0')->where('to','=','Admin')->select('to','from','data','id')->get();
            $admincount = Notification::where('read','=','0')->where('to','=','Admin')->select('to','from','data','id')->count();
           
            if ($admin->isEmpty()){
                $output =''; 
                $output .= '<a class="dropdown-item" style="text-align:center" href="#">No New Notifications</a>';
                echo $output;
            }
            else{                       
                     
                    foreach ($admin as $row){ 
                        
                        
                        $output ='';                                           
                        $output .= '<a class="dropdown-item" href="#" onclick="showNoti(\''.$row->data. '\',\''.$row->id.'\')">'.$row->data.'<br><small>'.$row->from.'</small></a>
                        <input type="hidden" id="count" value="'.$admincount.'">';
                        
                        echo $output;
                    }         
                
            }
        }

    }

    public function adminRead(Request $request){
        $nid = $request->nid;
        Notification::where('id','=',$nid)->update(['read'=>1]);
    }
  
    
}
