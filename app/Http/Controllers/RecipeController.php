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

  

    public function indexRecipe(){
        return view('inventory.recipe');
    }

    

    //happens when user clicks the green button
    public function store1 (Request $request){
        $recipe = new Recipe;        
        
        $dname = $request->get('dname');   
        $dtype = $request->get('dtype');   
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
            $recipe->dish_type = $dtype;
            $recipe->ingredients = $ingri;
            $recipe->amount = $amount;
            Log::info($dname); 
            Log::info($ingri);    
            Log::info($amount);    
            Log::info($length);          
            $recipe->save();
            
    }
        
    public function delete(Request $request){
        $recipe = new Recipe;        
        
        $dname = $request->get('dname');    
        $ingri = $request->get('ingri');
        $amount = $request->get('amount');
        $length = $request->get('length');

        DB::table('recipes')->where(['dish_name'=>$dname, 'ingredients'=>$ingri])->delete();
    }

    public function submit(Request $request){
        Log::info('success');
        $output = '<div class="alert alert-success">
        {{session("success")}}        
    </div> ';
    echo $output;
        //return response()->json(['success' => 'Successfully Added!'], 200);   

    }
}
