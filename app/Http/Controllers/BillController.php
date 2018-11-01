<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Bill;
use App\Dish;
use DB;
use Log;

class BillController extends Controller
{   
    //Get dish name when user types dish name
    public function fetchName(Request $request){       
        if($request->get('query')){            
            $query = $request->get('query');  
            Log::info($query);
            $data = Recipe::where('dish_name','like', '%'.$query.'%')->select('dish_name')->groupBy('dish_name')->get();              
            $output = '<ul class="dropdown-menu"  style="display:block; position:relative">';
            foreach($data as $row){                
                $output .= '<li id="list2"><a class="black-text dropdown-item" href="#">'.$row->dish_name.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    //set the data into bill table in db 
    public function store(Request $request){
        $bill = new Bill;
        $dish_name = $request->dish_name;
        $quantity = $request->quantity; 
        $dish_id = Dish::where('dish_name','like', '%'.$dish_name.'%')->select('dish_id')->value('dish_id'); 
        $unit_price = Dish::where('dish_name','like', '%'.$dish_name.'%')->select('unit_price')->value('unit_price'); 
        $bill->dish_id = $dish_id;
        $bill->dish_name = $dish_name;
        $bill->quantity = $quantity;
        $bill->price = $quantity*$unit_price;
        $bill->save();       
    }

    public function makeTable(Request $request){
        $bill = new Bill;
        $alldata = Bill::all();
        $output ='<table>';
        foreach ($alldata as $row) {
            Log::info($row);
            $output .='
            <tr>
                <td>'.$row->id.'</td>
                <td>'.$row->dish_name.'</td>
                <td>'.$row->dish_quantity.'</td>
                <td>'.$row->price.'</td>  
            </tr>';
        }
        $output .='</table>';
        echo $output;
        
        
    }
}
