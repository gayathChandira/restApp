<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use Log;
use DB;
use Illuminate\Support\Facades\Input;

class RecipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inven(){
        return view('inventoryMgr');
    }  

    public function indexRecipe(){
        return view('inventory.recipe');
    }

    // public function store(Request $request){
    //     $recipe = new Recipe;        
    //     $length = $request->input('loopLength');       
    //     //Log::info("last one ". $last_id);
        
    //     $result = Recipe::where('dish_id' , '=' , 1)->first();  //this is just to test the column empty or not
    //     if(!$result){    
    //         Log::info('it is empty');  // check whether dish_id column is empty. 
    //         $recipe->dish_id = 1;
    //     }else{
    //         $last_id = DB::table('recipes')->orderBy('dish_id','desc')->value('dish_id');   
    //         Log::info("Last id ".$last_id);     //if dish_id column isn't empty we add dish_id by one 
    //         $recipe->dish_id = $last_id + 1; 
    //     }
    //     $ingri_list = array();
    //     $amount_list = array();
    //     Log::info("len ".$length);
    //     $recipe->dish_name = $request->recipeName;  
    //     for($i = 0; $i<$length; $i++){            
    //         array_push($ingri_list,$request->ingri[$i]);
    //         array_push($amount_list,$request->amount[$i]);  
    //         Log::info('inside the for loop');  
    //     }
    //     $str_ingri = implode(',',$ingri_list);   //convert those arrays into strings
    //     $str_amount = implode(',',$amount_list);
    //     Log::info($str_ingri);
    //     //Log::info("ingri ".$ingri_list);
    //     $recipe->ingredients =  $str_ingri;
    //     $recipe->amount = $str_amount;

    //     $recipe->save();    
    //     //Log::info($users);

        
    //     // 
    //     return redirect('./inventory/recipe')->with('success', 'New Recipe Created!');
    // }

    // public function store(Request $request){
    //     $recipe = new Recipe;        
    //     $length = $request->input('loopLength'); 

    // }

    //happens when user clicks the green button
    public function store1 (Request $request){
        $recipe = new Recipe;        
        
        $dname = $request->get('dname');    
        $ingri = $request->get('ingri');
        $amount = $request->get('amount');
        $length = $request->get('length');      
        //Log::info("last one ". $last_id);
        
        $result = Recipe::where('dish_id' , '=' , 1)->first();  //this is just to test the column empty or not
        if(!$result){    
            Log::info('it is empty');  // check whether dish_id column is empty. 
            $recipe->dish_id = 1;
        }else{
            $last_id = DB::table('recipes')->orderBy('dish_id','desc')->value('dish_id');   
            Log::info("Last id ".$last_id);     //if dish_id column isn't empty we add dish_id by one 
            if($length>1){
                $recipe->dish_id = $last_id; 
            }else{
                $recipe->dish_id = $last_id +1 ; 
            }
            
        }
                  
            $recipe->dish_name = $dname;
            $recipe->ingredients = $ingri;
            $recipe->amount = $amount;
            Log::info($dname); 
            Log::info($ingri);    
            Log::info($amount);    
            Log::info($length);          
            $recipe->save();
            echo $length;
    }
        
    public function delete(Request $request){
        $recipe = new Recipe;        
        
        $dname = $request->get('dname');    
        $ingri = $request->get('ingri');
        $amount = $request->get('amount');
        $length = $request->get('length');

        DB::table('recipes')->where(['dish_name'=>$dname, 'ingredients'=>$ingri])->delete();
    }
}
