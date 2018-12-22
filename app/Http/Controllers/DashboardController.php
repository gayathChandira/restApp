<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Vendor;

class DashboardController extends Controller
{
    public function adminIndex(){
        $employee =  Employee::all();
        $vendor = Vendor::all();
        $data = array(
            'employee' => $employee,
            'vendor' => $vendor
        );
        return View ('admin.adminDash')->with($data);
    }
   
}
