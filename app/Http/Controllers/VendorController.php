<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use App\FoodItem;

class VendorController extends Controller
{
    public function index(){
        return view('admin.vendors');
    }

    public function setVendor(Request $request){
        $vendor = new Vendor;
        $fooditem = new FoodItem;
        $vendor->fname = $request->input('fname');
        $vendor->lname = $request->input('lname');
        $vendor->contact = $request->input('contact');
        $vendor->email = $request->input('email');
       
        $length = $request->input('length');  //length of the array (to the for loop)
        $foodids = $request->input('food_ids');  
        $arrayy = explode(',', $foodids);   //array of food-ids 
        
        $vendor->save();
        echo $vendor->id;

        //update fooditems table's vendor_id  
        for($i=0;$i<$length;$i++){
            FoodItem::where('id', 'like', '%'.$arrayy[$i].'%')->update(['vendor_id'=>$vendor->id]);
        }
        
       
    }
}
