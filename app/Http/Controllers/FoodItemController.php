<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FoodItem;
use App\ FoodItemUpdate;
use DB;
use Log;

class FoodItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUpdate()
    {
        $foodItemsfromDB = FoodItem::all();
        return view('inventory.update')->with('fooditems', $foodItemsfromDB);
    }
    public function indexAddNew()
    {
        return view('inventory.addnew');
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
    public function fetch(Request $request){
        if($request->get('query')){            
            $query = $request->get('query');                   
            $data = DB::table('food_items')->where('id', 'like', '%'.$query.'%')->get();            
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row){                
                $output .= '<li><a class="black-text dropdown-item" href="#">'.$row->id.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    public function fetchItemName(Request $request){
       
        if($request->get('query')){            
            $query = $request->get('query');                   
            $data = DB::table('food_items')->where('id', 'like', '%'.$query.'%')->value('itemName');    
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
        $foodItem->save();
    }
    public function store(Request $request)
    {   //food items updating to the database food_item_update table        
        $foodItemUP = new  FoodItemUpdate;
        $foodItem = new  FoodItem;
        // Getting current quantity of the food item
        $items = FoodItem::where('id', 'like', '%'.$request->input('foodItem_id').'%')->value('quantity');       

        //current quantitiy + updated quantity
        $sum = $items + $request->input('quantity');
        $foodItem->quantity =$request->input('quantity');

        //update new quantity on Food_items table
        FoodItem::where('id', 'like', '%'.$request->input('foodItem_id').'%')->update(['quantity'=>$sum]);        

        
        $foodItemUP->item_id = $request->input('foodItem_id');
        $foodItemUP->quantity = $request->input('quantity');
        $foodItemUP->vendor_id = $request->input('vendor');
        $foodItemUP->save();
        $foodItem->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
