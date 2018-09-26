<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/admin', function () {
    return view('admin');
});
Route::get('/cashier', function () {
    return view('cashier');
});
Route::get('/accountant', function () {
    return view('accountant');
});
Route::get('/inventory','RecipeController@inven');
Route::post('foodItems/fetch', 'FoodItemController@fetch')->name('FoodItemController.fetch');
Route::post('foodItems/fetchItemName', 'FoodItemController@fetchItemName')->name('FoodItemController.fetchItemName');
Route::post('foodItems/fetchNameWhenType', 'FoodItemController@fetchNameWhenType')->name('FoodItemController.fetchNameWhenType');
Route::post('foodItems/fetchID', 'FoodItemController@fetchID')->name('FoodItemController.fetchID');
Route::get('/inventory/update', 'FoodItemController@indexUpdate');
Route::get('/inventory/addnew', 'FoodItemController@indexAddNew');
Route::get('/inventory/recipe', 'RecipeController@indexRecipe');
Route::post('recipes/store', 'RecipeController@store');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('foodItems/storenew', 'FoodItemController@storenew');

Route::resource('foodItems', 'FoodItemController');

Route::get('/admin/vendors','VendorController@index');
Route::post('/admin/vendors','VendorController@setVendor');