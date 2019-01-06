<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Vendor;
use App\BillPaid;
use Log;
use DB;
use Carbon\Carbon;
use DateTime;
use App\IssueFoodItem;
use App\FoodItemQuantity;
use App\Dish;


class DashboardController extends Controller
{
        public function __construct()
        {
            $this->middleware('auth');
        }  


    public function adminIndex(){

        $firstdate = BillPaid::orderBy('created_at', 'desc')->first()->created_at;  //get the last date of the bill
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
            $date = date('Y-m-d', strtotime($date . ' -1 days'));    //deduct day by day            
        } 

        $datearray = array_reverse($datearray);
        $pricearray = array_reverse($pricearray);                
        $billdates = BillPaid::select(DB::raw('DATE(created_at) as day'))->groupBy('day')->orderBy('day', 'desc')->get();
        $daytable = BillPaid::where('created_at','like','%'.$firstdate.'%')->get();     
        $employee =  Employee::all();
        $vendor = Vendor::all();

        $weeks = BillPaid::select(DB::raw('WEEK(created_at) as week'))->groupBy('week')->orderBy('week', 'desc')->get();  //this will get us the week numbers from start to end of data
        //$months = BillPaid::select(DB::raw('MONTH(created_at) as month'))->groupBy('month')->orderBy('month', 'desc')->get();   //this will get us the month numbers from start to end of data
        //Log::info($months);     
        $results = BillPaid::select('created_at')
        ->orderBy('created_at','desc')
        ->get()
        ->groupBy(function (BillPaid $item) {
            return $item->created_at->format('Y-m');
        });
        //Log::info($results->keys());    //this will get the year and month 2019-01
        $months = $results->keys();
        $date = Carbon::now(); 
        $weekarray = array();     //this array includes start date and end date of each weeks. 
        
        foreach($weeks as $week){            
            //Log::info($week->week);
            $weekNumber = $week->week;
            $date->setISODate(2018,($weekNumber+1)); //when given a week number it returns start date of that week
            $start = $date->startOfWeek()->toDateTimeString();    //get the start date of the week
            $end =  $date->endOfWeek()->toDateTimeString();      // get the end date of the week
            $weekly = array(
                "start" => explode(" ",$start)[0],
                "end" => explode(" ",$end)[0]
            );           
            array_push($weekarray,$weekly);
        }
        $montharray = array();     //this array includes start date and end date of each month. 
        
        $monthswithyears = array();
        foreach($months as $month){             
            array_push($monthswithyears,$month);
            $firstday = $month.'-01';          //first date of the month
            $lastday = date("Y-m-t", strtotime($firstday));            //last date of the month
               
            $monthly = array(
                "start" => $firstday,
                "end" => $lastday
            );           
            array_push($montharray,$monthly);
        }
       // $monthswithyears = str_replace('"', '', json_encode($monthswithyears));
        Log::info($monthswithyears);
        

        $today = Carbon::now();
        $one_week_ago = Carbon::now()->subWeeks(1);
        $weeklytable = BillPaid::selectRaw( 'dish_id , dish_name ,sum(price) as totalPrice , sum(quantity) as totalQuantity')
            ->whereBetween('created_at', [$one_week_ago, $today])
            ->groupBy('dish_id')->get();       

                 
        //Log::info($weeklytable);

        $data = array(
            'employee' => $employee,
            'vendor' => $vendor,
            'pricearray' => $pricearray,
            'datearray' => $datearray,
            'daytable' => $daytable,
            'billdates' => $billdates,
            'weeklytable' => $weeklytable,
            'weeks' => $weekarray,
            'months' => $montharray,
            'monthsyears' => $monthswithyears
        );
        return View ('admin.adminDash')->with($data);
    }
   
    //for day table admin dash
    public function daytable(Request $request){
        $selectedDate = $request->get('date');      
        $daytable = BillPaid::where('created_at','like','%'.$selectedDate.'%')->get();
        $output ='<table id="daytable" class="table table-striped table-responsive-sm" cellspacing="0" width="100%">
        <thead>
            <tr>
            <th class="th-lg">ID
            </th>
            <th class="th-lg">Food Item Name
            </th>                           
            <th class="th-lg">Quantity
            </th>
            <th class="th-lg">Price
            </th>    
            <th class="th-lg">Time
            </th>                  
            </tr>
        </thead>   
        <tbody >';
        foreach($daytable as $day){
            $output .= '<tr>
            <td>'. $day->id.' </td>
            <td>'. $day->dish_name.' </td>                                
            <td>'. $day->quantity.' </td>
            <td>'. $day->price.' </td>    
            <td>'. explode(" ",$day->created_at)[1].' </td>                        
        </tr>
        <input type="hidden" id="date" value="'.$selectedDate.'">';
        }
        $output .= '</tbody>
        <tfoot>
            <tr>
            <th>ID
            </th>
            <th>Food Item Name
            </th>                           
            <th>Quantity
            </th>
            <th>Price
            </th>   
            <th>Time
            </th>                      
            </tr>
        </tfoot>
        </table>
        <a class="btn btn-sm btn-primary" onclick="print(\'daytable\')">Get Report</a>';
        echo $output; 
            
    }
    //for weekly table admin dash
    public function weektable(Request $request){
        $startday = $request->get('start');
        $endday = $request->get('end');      
        $weeklytable = BillPaid::selectRaw( 'dish_id , dish_name ,sum(price) as totalPrice , sum(quantity) as totalQuantity')
            ->whereBetween('created_at', [$startday, $endday])
            ->groupBy('dish_id')->get();           
        $output = '<table id="weeklytable" class="table table-striped table-responsive-sm" cellspacing="0" width="100%">
        <thead>
            <tr>
            <th class="th-lg">Dish ID
            </th>
            <th class="th-lg">Food Item Name
            </th>                           
            <th class="th-lg">Quantity
            </th>
            <th class="th-lg">Net Income (Rs)
            </th>                                         
            </tr>
        </thead>
        <tbody> ';  
        foreach($weeklytable as $week){
            $output .= '<tr>
            <td>'. $week->dish_id.' </td>
            <td>'. $week->dish_name.' </td>                                
            <td>'. $week->totalQuantity.' </td>
            <td>'. $week->totalPrice.' </td>                              
        </tr>
        <input type="hidden" id="startdate" value="'.$startday.'">
        <input type="hidden" id="enddate" value="'.$endday.'">';
        }     
        $output .= '</tbody>
        <tfoot>
            <tr>
            <th>Dish ID
            </th>
            <th>Food Item Name
            </th>                           
            <th>Quantity
            </th>
            <th>Net Income (Rs)
            </th>                                            
            </tr>
        </tfoot>
        </tabel>
        <a class="btn btn-sm btn-primary" onclick="print(\'weektable\')">Get Report</a>';              
        return response()->json([
            'output'=> $output,
            'weeklytable' => $weeklytable
        ]);  
    }


    public function inventoryIndex(){
        $today = Carbon::now()->toDateString();        
        $issuetable = IssueFoodItem::where('created_at','like','%'.$today.'%')->get();  //for today issued table
        $allissue = IssueFoodItem::all();   //for all issued table

        $itemNames = FoodItemQuantity::select('itemName')->groupBy('itemName')->get();

        $data = array(
            'issuetable' => $issuetable,
            'allissue' => $allissue,
            'itemNames' => $itemNames
        );
        return view ('inventory.inventoryDash')->with($data);
    }

    //inventory
    public function linegraph(Request $request){
        $selected  = $request->get('selected');
        Log::info($selected);
        $weekly = FoodItemQuantity::where('itemName','like','%'.$selected.'%')->get();
        Log::info($weekly);
        //$linearray = array();
        $quantityarray = array();
        $datearray = array();
        foreach ($weekly as $week){
            Log::info($week);
            $quanti = 
            array_push($quantityarray, $week->quantity);
            array_push( $datearray, explode(" ", $week->created_at)[0]);           
        }
        Log::info($quantityarray);
        return response()->json(array('quantity'=>$quantityarray,'dates'=>$datearray));
    }
//---------------------------------------------------------
    public function accountIndex(){
        $dish = Dish::all();        
        $weeks = BillPaid::select(DB::raw('WEEK(created_at) as week'))->groupBy('week')->orderBy('week', 'desc')->get();
        Log::info($weeks);     
        
        $date = Carbon::now(); 
        $weekarray = array();
        foreach($weeks as $week){
            
            //Log::info($week->week);
            $weekNumber = $week->week;
            $date->setISODate(2018,($weekNumber+1));
            $start = $date->startOfWeek()->toDateTimeString();
            $end =  $date->endOfWeek()->toDateTimeString();
            $weekly = array(
                "start" => explode(" ",$start)[0],
                "end" => explode(" ",$end)[0]
            );           
            array_push($weekarray,$weekly);
        }
       
        Log::info($weekarray);
        $today = Carbon::now();
        $one_week_ago = Carbon::now()->subWeeks(1);
        $weeklytable = BillPaid::selectRaw( 'dish_id , dish_name ,sum(price) as totalPrice , sum(quantity) as totalQuantity')
            ->whereBetween('created_at', [$one_week_ago, $today])
            ->groupBy('dish_id')->get();       

                 

        $data = array(
            'weeks' => $weekarray,
            'dishes'=>$dish,
            'weeklytable' => $weeklytable
        );    
        return view('account.accountDash')->with($data);
    }

    //for price table account dash
    public function pricetable(Request $request){
        $startday = $request->get('start');
        $endday = $request->get('end');
        $weeklytable = BillPaid::selectRaw( 'dish_id , dish_name ,sum(price) as totalPrice , sum(quantity) as totalQuantity')
            ->whereBetween('created_at', [$startday, $endday])
            ->groupBy('dish_id')->get();  
        $output = '<table id="weeklytable" class="table table-striped table-responsive-sm" cellspacing="0" width="100%">
        <thead>
            <tr>
            <th class="th-lg">Dish ID
            </th>
            <th class="th-lg">Food Item Name
            </th>                           
            <th class="th-lg">Quantity
            </th>
            <th class="th-lg">Net Price
            </th>                                         
            </tr>
        </thead>
        <tbody> ';  
        foreach($weeklytable as $week){
            $output .= '<tr>
            <td>'. $week->dish_id.' </td>
            <td>'. $week->dish_name.' </td>                                
            <td>'. $week->totalQuantity.' </td>
            <td>'. $week->totalPrice.' </td>                              
        </tr>
        <input type="hidden" id="startdate" value="'.$startday.'">
        <input type="hidden" id="enddate" value="'.$endday.'">';
        }     
        $output .= '</tbody>
        <tfoot>
            <tr>
            <th>Dish ID
            </th>
            <th>Food Item Name
            </th>                           
            <th>Quantity
            </th>
            <th>Net Price
            </th>                                            
            </tr>
        </tfoot>
        </tabel>';
        echo $output;

    }
}
