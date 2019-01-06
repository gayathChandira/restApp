<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\FoodItem;
use App\Bill;
use App\Dish;
use App\BillPaid;
use DB;
use Log;
use PDF;

class BillController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    } 
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

        $output ='<table style="width: -webkit-fill-available;">
        <tr>
            <td></td>
            <td class="font-weight-bold">Food Item</td>
            <td class="font-weight-bold">Quantity</td>
            <td class="font-weight-bold">Price</td>
        </tr>';
        $netprice=0;
        foreach ($alldata as $row) {
           // Log::info($row);
            $output .='
            <tr>
                <td>'.$row->id.'</td>
                <td>'.$row->dish_name.'</td>
                <td>'.$row->quantity.'</td>
                <td>'.$row->price.'</td>  
                <td><a href="#" onclick="remove('.$row->id.')" class="btn btn-danger btn-sm"><i class="fa fa-close" aria-hidden="true"></i></a></td>
            </tr>';
            $netprice = $row->price + $netprice;
        }
        $output .=' <tr style="border-top-style: solid;">
        <td colspan="3" style="text-align: left; font-weight: 500;">Net Price</td>      
        <td>'.$netprice.'</td>        
        </tr></table><a href="#" onclick="paid()" class="btn btn-primary btn-md">Proceed!</a></a>';
        echo $output;        
        
    }
    //happen when user clicks red x button in bill
    public function billRemove(Request $request){
        $bill_id = $request->bill_id;
        Bill::where('id',$bill_id)->delete();
    }

    //when user click proceed button
    public function storePaid(){
        $bill = new Bill;        
        $bill_data = Bill::all();
       // Log::info('dfdf');
        //Log::info($bill_data);
        foreach ($bill_data as $row){
            $billPaid = new BillPaid;
            Log::info( $row->dish_id);
            $dish_id = $row->dish_id;
            $billPaid->dish_id = $row->dish_id;
            $billPaid->dish_name = $row->dish_name;
            $billPaid->quantity = $row->quantity;
            $billPaid->price = $row->price;
            $billPaid->save();



            $food_items = Recipe::where('dish_id','=',$dish_id )->select('ingredients','amount')->get();
       
        }
        
        $pdf = PDF::loadView('invoice',compact('bill_data'));   
        return $pdf->download('invoice.pdf');
    }


    public function index(){
        $shorteats = Recipe::where('dish_type','=','shorteats')->select('dish_name')->groupBy('dish_name')->get();
        $rice = Recipe::where('dish_type','=','rice')->select('dish_name')->groupBy('dish_name')->get();
        $noodles = Recipe::where('dish_type','=','noodles')->select('dish_name')->groupBy('dish_name')->get();
        $soup = Recipe::where('dish_type','=','soups')->select('dish_name')->groupBy('dish_name')->get();
        $beverages = Recipe::where('dish_type','=','beverages')->select('dish_name')->groupBy('dish_name')->get();
        $data = array(
            'rice' => $rice,
            'shorteats' => $shorteats,
            'noodles' => $noodles,
            'soup' => $soup,
            'beverages' => $beverages
        );
        return view ('cashier.bill')->with($data);
    }
    
}
