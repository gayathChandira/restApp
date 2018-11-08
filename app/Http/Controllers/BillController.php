<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Bill;
use App\Dish;
use App\BillPaid;
use DB;
use Log;

class BillController extends Controller
{   
    //Get dish name when user types dish name
    public function fetchName(Request $request){       
        if($request->get('query')){            
            $query = $request->get('query');  
            
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
        
        $billData = Bill::all();
        $num = $request->num;
        
        if($num == 0){
            Bill::truncate();  // delete all records in db 
        }
        $dish_name = $request->dish_name;
        $quantity = $request->quantity; 
       
        
  
        $unit_price = Dish::where('dish_name','like', '%'.$dish_name.'%')->select('unit_price')->value('unit_price'); 
        $result = Bill::where('dish_name', '=',$dish_name)->first();
        if ($result){  //if user enter same dish again 
            Log::info('resutl');
            $oldQuantity = Bill::where('dish_name', '=',$dish_name)->value('quantity');                    
            $newQuantity = $oldQuantity + $quantity;
            $newPrice = $unit_price*$newQuantity;
            Log::info($newQuantity);
            Bill::where('dish_name', '=',$dish_name)->update(['quantity' => $newQuantity ]);
            Bill::where('dish_name', '=',$dish_name)->update(['price' => $newPrice ]);
        }else{
            $bill = new Bill;
            $bill->quantity = $quantity;
            $bill->price = $quantity*$unit_price;
            $dish_id = Dish::where('dish_name','like', '%'.$dish_name.'%')->select('dish_id')->value('dish_id');         
            $bill->dish_id = $dish_id;
            $bill->dish_name = $dish_name;
            $bill->save(); 
        }     
               
    }

    public function makeTable(Request $request){
        $bill = new Bill;
        $alldata = Bill::all();
        Log::info($alldata);

        $output ='<table>';
        foreach ($alldata as $row) {
           // Log::info($row);
            $output .='
            <tr>
                <td>'.$row->id.'</td>
                <td>'.$row->dish_name.'</td>
                <td>'.$row->dish_quantity.'</td>
                <td>'.$row->price.'</td>  
                <td><a href="#" onclick="remove('.$row->id.')" class="btn btn-danger btn-sm"><i class="fa fa-close" aria-hidden="true"></i></a></td>
            </tr>';
        }
        $output .='</table><a href="#" onclick="paid()" class="btn btn-primary btn-sm">Proceed!</a></a>';
        echo $output;
        
        
    }
    //happen when user clicks red x button in bill
    public function billRemove(Request $request){
        $bill_id = $request->bill_id;
        Bill::where('id',$bill_id)->delete();
    }

    public function storePaid(){
        $bill = new Bill;
        
        $bill_data = Bill::all();
        Log::info('dfdf');
        Log::info($bill_data);
        foreach ($bill_data as $row){
            $billPaid = new BillPaid;
            Log::info( $row->dish_name);
            $billPaid->dish_id = $row->dish_id;
            $billPaid->dish_name = $row->dish_name;
            $billPaid->quantity = $row->quantity;
            $billPaid->price = $row->price;
            $billPaid->save();
        }

    }
    public function dishDiv(){
        $dish_data = Dish::all();
        $output ='';   
        foreach($dish_data as $row){
            Log::info($row->dish_name);
           $output .='<div>
           <a href="#" onclick="order(\''.$row->dish_name.'\')" class="btn btn-li btn-lg">'.$row->dish_name.'</a>          
           </div>';
        }
        echo $output;
    }
}
