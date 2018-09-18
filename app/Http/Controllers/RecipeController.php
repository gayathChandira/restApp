<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;

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
    public function store(Request $request){
        $recipe = new Recipe;
        $recipe->meal_name = $request->recipeName;
        // $length = $request->input('loopLength');
        // echo "len".$length;
        // for($i = 0; $i<$length; $i++){
            $recipe->ingredients = $request->array1[$i][0];
            //$recipe->ingredients = $request->array1[$i][1];        }
        $recipe->save();
    }
}
