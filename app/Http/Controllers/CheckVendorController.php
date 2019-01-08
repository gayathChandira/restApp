<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FoodItem;
use App\Vendor;
use Log;

class CheckVendorController extends Controller
{    //this is for checking who is the vendor for food items

    public function __construct()
    {
        $this->middleware('auth');
    } 
    
    public function checkfoodIndex(){
        $fooditems = FoodItem::all();
        return view('admin.checkfood')->with('fooditem',$fooditems);
    }

    public function check(Request $request){
        $fooditem = $request->get('values');
        $vendorIds = FoodItem::where('itemName','=',$fooditem)->value('vendor_id');
        Log::info($vendorIds);
        $vendorIds = trim($vendorIds, ' ');
        $ids = explode(' ',$vendorIds);
        $output ='<table class="table table-sm ml-5 mt-5 table-responsive-sm" style="max-width:90%">
        <thead>
          <tr>
            <th scope="col">Vendor ID</th>
            <th scope="col">Vendor Name</th>
            <th scope="col">Contact Number</th>
            <th scope="col">Email Address</th>     
          </tr>
        </thead>
        <tbody>';
        foreach($ids as $id){
            $vendor = Vendor::where('id','=',$id)->first();
            Log::info($vendor);
            $output .= '<tr>
            <td>'.$vendor->id.'</td>
            <td>'.$vendor->fname.' '. $vendor->lname.'</td>
            <td>'.$vendor->contact.'</td>
            <td>'.$vendor->email.'</td>
            </tr>';
        }   
        $output .= '</tbody>
        </table>';  
        echo $output;
        
    }
}
