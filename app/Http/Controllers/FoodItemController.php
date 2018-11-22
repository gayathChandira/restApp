<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FoodItem;
use App\FoodItemUpdate;
use App\FoodItemQuantity;
use DB;
use Log;

class FoodItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }  
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUpdate(){
        $foodItemsfromDB = FoodItem::all();
        return view('inventory.update')->with('fooditems', $foodItemsfromDB);
    }
    public function indexAddNew(){
        return view('inventory.addnew');
    }    
    public function indexIssue(){
        return view('inventory.issue');
    }  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    //fetching item-id from the db
    public function fetch(Request $request){
        if($request->get('query')){            
            $query = $request->get('query');                   
            $data = DB::table('food_items')->where('id', 'like', '%'.$query.'%')->get();            
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row){                
                $output .= '<li id="list1"><a class="black-text dropdown-item" href="#">'.$row->id.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    //fetching item name from the db when item-id select
    public function fetchItemName(Request $request){       
        if($request->get('query')){            
            $query = $request->get('query');                   
            $data = DB::table('food_items')->where('id', 'like', '%'.$query.'%')->value('itemName');    
            $output = $data;           
            echo $output;
        }
    }
    //fetching item-name when typing item name
    public function fetchNameWhenType(Request $request){
        if($request->get('query')){            
            $query = $request->get('query');                   
            $data = DB::table('food_items')->where('itemName', 'like', '%'.$query.'%')->get();            
            $output = '<ul class="dropdown-menu"  style="display:block; position:relative">';
            foreach($data as $row){                
                $output .= '<li id="list2"><a class="black-text dropdown-item" href="#">'.$row->itemName.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
   //fetching item-id from the db when item-name select
    public function fetchID(Request $request){       
        if($request->get('query')){            
            $query = $request->get('query');                   
            $data = DB::table('food_items')->where('itemName', 'like', '%'.$query.'%')->value('id');    
            $output = $data;           
            echo $output;
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storenew(Request $request)  
    {   //add new food items into database
        $foodItem = new  FoodItem;
        $foodItem->itemName = $request->input('foodItem');
        $foodItem->unit = $request->input('unit');     
        $foodItem->limit = $request->input('limit');  
        $foodItem->save();
        return redirect('./inventory/addnew')->with('success', 'New Item Created');
    }
    public function store(Request $request)
    {   //food items updating to the database food_item_update table        
        $foodItemUP = new  FoodItemUpdate;
        $foodItem = new  FoodItem;
        // Getting current quantity of the food item
        $items = FoodItem::where('id', 'like', '%'.$request->input('foodItem_id').'%')->value('quantity');       

        //current quantitiy + updated quantity
        $sum = $items + $request->input('quantity');
        $fdQuantity = new FoodItemQuantity;
        $fdQuantity->itemName = $request->foodItem;
        $fdQuantity->quantity = $sum;
        $fdQuantity->save();    

        //update new quantity on Food_items table
        FoodItem::where('id', 'like', '%'.$request->input('foodItem_id').'%')->update(['quantity'=>$sum]);         
        FoodItem::where('id', 'like', '%'.$request->input('foodItem_id').'%')->update(['unit_price'=>$request->input('unitPrice')]);
        $foodItemUP->item_id = $request->input('foodItem_id');
        $foodItemUP->quantity = $request->input('quantity');        
        $foodItemUP->vendor_id = $request->input('vendor');
        $foodItemUP->save();
        return redirect('./inventory/update')->with('success', 'Stock Updated!');
    }
    
    //load edit inputs automatically when user types fooditem
    public function editItem(Request $request){
        $foodItem = $request->get('query');
        $output =FoodItem::where('itemName','=',$foodItem)->select('unit','limit')->get();
        foreach ($output as $row){
            $unit =$row->unit;
            $limit = $row->limit;                 
        }
        return response()->json([
            'unit' => $unit,
            'limit' => $limit
        ]);        
    }
    
    //submit the edited details
    public function editSubmit(Request $request){
        $food_item = new FoodItem;
        $fooditem = $request->foodItem;
        FoodItem::where('itemName','=',$fooditem)->update(['unit'=>$request->unit,'limit'=>$request->limit]);
        return redirect()->back()->with('success', 'Successfully Changed!');   
    }
}
