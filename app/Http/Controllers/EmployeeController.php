<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\FoodItem;
use DB;
use Log;

class EmployeeController extends Controller
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
        
        return view('admin.employees');
    }
    //add new employee to the db ----------------
    public function setEmployee(Request $request){
        $employee = new Employee;

        $employee->fname = $request->input('fname');
        $employee->lname = $request->input('lname');
        $employee->age = $request->input('age');
        $employee->contact = $request->input('contact');
        $employee->email = $request->input('email');
            
        $employee->save();        
        return redirect()->back()->with('success', 'Added the New Employee!');            
       
    }
       // edit vendor----------------------
     //fetching vendor-id from the db
     public function fetchID(Request $request){
        if($request->get('query')){            
            $query = $request->get('query');                   
            $data = DB::table('employees')->where('id', 'like', '%'.$query.'%')->get();            
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row){                
                $output .= '<li id="list1"><a class="black-text dropdown-item" href="#">'.$row->id.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
     //fetching employee name from the db when id select
     public function fetchEmployeeName(Request $request){       
        if($request->get('query')){            
            $query = $request->get('query');                   
            $data = DB::table('employees')->where('id', 'like', '%'.$query.'%')->value('fname');    
            $output = $data;           
            echo $output;
        }
    }
    //fetching employee-name when typing employee name
    public function fetchNameWhenType(Request $request){
        if($request->get('query')){            
            $query = $request->get('query');                   
            $data = DB::table('employees')->where('fname', 'like', '%'.$query.'%')->get();            
            $output = '<ul class="dropdown-menu"  style="display:block; position:relative">';
            foreach($data as $row){                
                $output .= '<li id="list2"><a class="black-text dropdown-item" href="#">'.$row->fname.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }//fetching employee-id from the db when employee-name select
    public function fetchemployeeID(Request $request){       
        if($request->get('query')){            
            $query = $request->get('query');                   
            $data = DB::table('employees')->where('fname', 'like', '%'.$query.'%')->value('id');    
            $output = $data;           
            echo $output;
        }
    }
    public function editEmployee(Request $request){
        if($request->get('query')){                                 
            $query = $request->get('query'); 
                  
            $data = DB::table('employees')->where('id','=', $query)->get();  
            foreach($data as $row){   
                            
                $output = '<div class="editform">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="fname" value="'.$row->fname.'" class="form-control" placeholder="First Name">
                </div>
                <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" value="'.$row->lname.'" class="form-control" placeholder="Last Name">
                </div>
                <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="age" value="'.$row->age.'" class="form-control" placeholder="Age">
                </div>
                <div class="form-group">
                        <label>Contact</label>
                        <input type="text" name="contact" value="'.$row->contact.'" class="form-control" placeholder="Contact Number">
                </div>
                <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="'.$row->email.'" class="form-control" placeholder="Email Address">
                </div>
                <input type="hidden" value="'.$row->id.'" name="emp_id">
                <input type="submit" value="Submit" class="btn btn-primary">
            </div>   ';     
              
            echo $output;    
            }
        }   
    }
    //update employee details query 
    public function updateEmployee(Request $request){        
        DB::table('employees')->where('id','=',$request->emp_id)
        
        ->update(['fname'=>$request->fname,
        'lname'=>$request->lname,
        'age'=>$request->age,
        'email'=>$request->email,
        'contact'=>$request->contact]);
        return redirect()->back()->with('success', 'Employee Details Updated!');
    }
    //Delete vendor from the db
    public function removeEmployee(Request $request){       
        DB::table('employees')->where('id', '=', $request->empid)->delete();
        return redirect()->back()->with('error', 'Vendor Details Deleted!');
    }

}