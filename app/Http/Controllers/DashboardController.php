<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Vendor;
use App\BillPaid;
use Log;

class DashboardController extends Controller
{
    public function adminIndex(){
        $firstdate = BillPaid::select('created_at')->first()->value('created_at');  //get the last date of the bill
        $firstdate = explode(" ",$firstdate)[0];
        $date = $firstdate;
        $pricearray = array();
        $datearray = array();
        for ($x = 0; $x < 7; $x++) {      
            $netIncome =0;      
            $prices = BillPaid::where('created_at','like','%'.$date.'%')->select('price')->get();
            foreach($prices as $price){
                $netIncome = $price->price + $netIncome;
            }
            array_push($pricearray,$netIncome);   //append net income to price array
            array_push($datearray,$date);
            // Log::info($date);
            // Log::info($prices);
            // Log::info($netIncome);
            $date = date('Y-m-d', strtotime($date . ' -1 days'));    //deduct day by day            
        } 
        $datearray = array_reverse($datearray);
        $pricearray = array_reverse($pricearray);     
        Log::Info($pricearray);
     



        //Log::info($firstdate);
        //Log::info($date);
        $employee =  Employee::all();
        $vendor = Vendor::all();
        $data = array(
            'employee' => $employee,
            'vendor' => $vendor,
            'pricearray' => $pricearray,
            'datearray' => $datearray
        );
        return View ('admin.adminDash')->with($data);
    }
   
}
