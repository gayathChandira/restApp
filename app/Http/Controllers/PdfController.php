<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class PdfController extends Controller
{
    public function employeePdf(){
        $employee =  Employee::all();
        return view('pdf.currentEmployees')->with('employee',$employee);
    }
}
