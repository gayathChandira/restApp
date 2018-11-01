<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\Recipe;
use DB;
use Log;

class PriceController extends Controller
{
    public function store(Request $request){
        $dish = new Dish;
        $dish_name = $request->dish_name;
        $price = $request->price;       
        $dish_id = Recipe::where('dish_name','like', '%'.$dish_name.'%')->select('dish_id')->groupBy('dish_id')->value('dish_id');         
        $dish->dish_id = $dish_id;
        $dish->dish_name = $dish_name;
        $dish->unit_price = $price;
        $dish->save();
    }
}
