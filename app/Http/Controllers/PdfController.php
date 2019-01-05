<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Vendor;
use PDF;
use Log;

class PdfController extends Controller
{
    public function employeePdf(){
        $employee =  Employee::all();
    
        //return view('pdf.currentEmployees')->with('employee',$employee);
        $pdf = PDF::loadView('pdf.currentEmployees',compact('employee'));   
        return $pdf->download('employee.pdf');       
    }

    public function vendorPdf(){
        $vendor =  Vendor::all();
    
        //return view('pdf.vendors')->with('vendor',$vendor);
        $pdf = PDF::loadView('pdf.vendors',compact('vendor'));   
        return $pdf->download('vendor.pdf');       
    }

    public function dayPdf(Request $request){
        //Log::info('day controller');
        $data = $request->get('daytabledata');
        //Log::info($data);
        $pdf = PDF::loadView('pdf.daytable',compact('data'));   
        return $pdf->download('daytable.pdf');  
      
             
    }
    public function weekPdf(Request $request){
        //Log::info('day controller');
        $data = $request->get('weekstabledata');
        //Log::info($data);
        $pdf = PDF::loadView('pdf.weektable',compact('data'));   
        return $pdf->download('weektable.pdf');  
      
             
    }
   
}

