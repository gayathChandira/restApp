<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Issue_fd_temp;
use App\IssueFoodItem;
use App\FoodItem;
use App\FoodItemQuantity;
use App\Notification;
use App\User;
use Log;
use Auth;

class IssueFoodItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }  
    public function store(Request $request){

        $num = $request->num;        
        if($num == 0){
            Issue_fd_temp::truncate();  // delete all records in db 
        }
        $temp = new Issue_fd_temp;
        $temp->food_item = $request->item_name;
        $temp->quantity = $request->quantity;
        $temp->save();
    }

    public function makeTable(Request $request){
        
       // $temp = new Issue_fd_temp;
        $alldata =Issue_fd_temp::all();        
        Log::info($alldata);
        $output ='<table>';
        foreach ($alldata as $row) {
           // Log::info($row);
            $output .='
            <tr>                
                <td>'.$row->food_item.'</td>
                <td>'.$row->quantity.'</td>                
                <td><a href="#" onclick="remove(\''.$row->food_item.'\')" class="btn btn-danger btn-sm"><i class="fa fa-close" aria-hidden="true"></i></a></td>
            </tr>';
        }
        $output .='</table><a href="#" onclick="submit()" class="btn btn-primary btn-sm">Proceed!</a></a>';
        echo $output;        
        
    }
    //when user wants to remove issuing items
    public function issueRemove(Request $request){
        $food_item = $request->food_item;
        Issue_fd_temp::where('food_item',$food_item)->delete();
    }
    //save data in permanant table
    public function submit(){
        $tempdata = Issue_fd_temp::all();
        foreach($tempdata as $row){
            $issued = new IssueFoodItem;
            $issued->food_item = $row->food_item;
            $issued->quantity = $row->quantity;
            $issued->save();          
           
            //update quantity in food-item table
            $old_quantitiy = FoodItem::where('itemName','=',$row->food_item)->value('quantity');          
            $reduce = $row->quantity;
            $new_quantity = $old_quantitiy - $reduce;          
            FoodItem::where('itemName','=',$row->food_item)->update(['quantity'=>$new_quantity]);  
            
            //add new quantity to fd quantity table
            $fdQunatity = new FoodItemQuantity;
            $fdQunatity->itemName = $row->food_item;           
            $fdQunatity->quantity = $new_quantity;          
            $fdQunatity->save();

            //send notification if it's behind the limit
            $limit = FoodItem::where('itemName','=',$row->food_item)->value('limit');
            if($limit>=$new_quantity){
               
                $noti = new Notification;
                $noti->from = 'Inventory Manager';
                $noti->to = 'Accountant';
                $noti->read = 0;
                $noti->data = ''.$row->food_item." has fall behind its limit";
                $noti->save();               
            }
        }
    }

}
