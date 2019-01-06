<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FoodItem;
use App\Vendor;
use App\Notification;
use Log;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    } 
    public function index(){
        return view ('account.order');
    }
    public function index1($id){
        $foodname = FoodItem::where('id','=',$id)->value('itemName');
        return view ('account.order')->with('foodname',$foodname);
    }

    //get the unit of food item
    public function fetchUnit(Request $request){    
        $fooditem =$request->get('query');    
        $unit = FoodItem::where('itemName','=',$fooditem)->value('unit');
        Log::info($unit);
        echo $unit;
    }
    //get the vendor of food item
    public function vendorLoad(Request $request){
        $fooditem =$request->get('query');    
        $vendors = FoodItem::where('itemName','=',$fooditem)->value('vendor_id');
        Log::info($vendors);
        $arr =  explode(" ", $vendors);
        array_shift($arr);
        Log::info($arr);
        $output = '<ul class="dropdown-menu"  style="display:block; position:relative">';
        foreach ($arr as $row){            
            $vendor = Vendor::where('id','=',$row)->select('fname','lname')->get();
            Log::info($vendor);            
            foreach($vendor as $row2){                
                $output .= '<li id="list3"><a class="black-text dropdown-item" href="#">'.$row2->fname.' '.$row2->lname.'</a></li>';
            }      
        }
        $output .= '</ul>';
        echo $output;
    }

    public function fillForm(Request $request){
        Log::info($request->food);
        $foodName = $request->food;
        $id = FoodItem::where('itemName','=',$foodName)->value('id');
        $nid = $request->nid;
        Notification::where('id','=',$nid)->update(['read'=>1]);
        echo $id;
        
    }
}
