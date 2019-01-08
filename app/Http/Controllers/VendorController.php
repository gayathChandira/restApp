<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use App\FoodItem;
use DB;
use Log;

class VendorController extends Controller
{
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }  
    public function index(){
        
        return view('admin.vendors');
    }
    //add new vendor to the db ----------------
    public function setVendor(Request $request){

        $validatedData = $request->validate([
            'contact' => 'required|max:10',
            'email' => 'required|string|email|max:255|unique:vendors',            
        ]);
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

        //update fooditems table's vendor_id  
        for($i=0;$i<$length;$i++){
            $oldvendors = FoodItem::where('id', 'like', '%'.$arrayy[$i].'%')->value('vendor_id');
            $oldvendors .= " $vendor->id";
            //echo $oldvendors;

            // $array2 = explode(',',$oldvendors);
            // echo count($array2);
            // $array2($vendor->id);
            // echo $array2;
            FoodItem::where('id', 'like', '%'.$arrayy[$i].'%')->update(['vendor_id'=>$oldvendors]);
        }
        
        return redirect()->back()->with('success', 'Vendor Details Added!');
       
    }
       // edit vendor----------------------
     //fetching vendor-id from the db
     public function fetchID(Request $request){
        if($request->get('query')){            
            $query = $request->get('query');                   
            $data = DB::table('vendors')->where('id', 'like', '%'.$query.'%')->get();    
            Log::info($data);        
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row){                
                $output .= '<li id="list1"><a class="black-text dropdown-item" href="#">'.$row->id.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
     //fetching vendor name from the db when id select
     public function fetchVendorName(Request $request){       
        if($request->get('query')){            
            $query = $request->get('query');                   
            $data = DB::table('vendors')->where('id', 'like', '%'.$query.'%')->value('fname');    
            $output = $data;           
            echo $output;
        }
    }
    //fetching vendor-name when typing vendor name
    public function fetchNameWhenType(Request $request){
        if($request->get('query')){            
            $query = $request->get('query');                   
            $data = DB::table('vendors')->where('fname', 'like', '%'.$query.'%')->get();            
            $output = '<ul class="dropdown-menu"  style="display:block; position:relative">';
            foreach($data as $row){                
                $output .= '<li id="list2"><a class="black-text dropdown-item" href="#">'.$row->fname.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }//fetching vendor-id from the db when vendor-name select
    public function fetchvendorID(Request $request){       
        if($request->get('query')){            
            $query = $request->get('query');                   
            $data = DB::table('vendors')->where('fname', 'like', '%'.$query.'%')->value('id');    
            $output = $data;           
            echo $output;
        }
    }
    public function editVendor(Request $request){
        if($request->get('query')){                                 
            $query = $request->get('query'); 
                   
            $data = DB::table('vendors')->where('id','=', $query)->get();  
            foreach($data as $row){   
                              
                $output = '<div class="editform">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="fname" value="'.$row->fname.'" class="form-control" placeholder="First Name" required>
                </div>
                <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" value="'.$row->lname.'" class="form-control" placeholder="Last Name" required>
                </div>
                <div class="form-group">
                        <label>Contact</label>
                        <input type="text" name="contact" value="'.$row->contact.'" class="form-control" placeholder="Contact Number" required>
                </div>
                <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="'.$row->email.'" class="form-control" placeholder="Email Address" required>
                </div>
                <input type="hidden" value="'.$row->id.'" name="vendor_id">
                <input type="submit" value="Submit" class="btn btn-primary">
            </div>   ';     
                 
            echo $output;    
            }
        }   
    }
    //update vendor details query 
    public function updateVendor(Request $request){
       
        DB::table('vendors')->where('id','=',$request->vendor_id)
        
        ->update(['fname'=>$request->fname,
        'lname'=>$request->lname,
        'email'=>$request->email,
        'contact'=>$request->contact]);
        return redirect('./admin/vendors')->with('success', 'Vendor Details Updated!');
    }
    //Delete vendor from the db
    public function removeVendor(Request $request){

        
        DB::table('vendors')->where('id', '=', $request->vendorid)->delete();
        return redirect('./admin/vendors')->with('error', 'Vendor Details Deleted!');
    }

}


// 