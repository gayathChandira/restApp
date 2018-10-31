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
Route::post('/admin/vendors','VendorController@setVendor')->name('VendorController.setVendor');
Route::post('vendors/fetchID','VendorController@fetchID')->name('VendorController.fetchID');
Route::post('vendors/fetchNameWhenType','VendorController@fetchNameWhenType')->name('VendorController.fetchNameWhenType');
Route::post('vendors/fetchVendorName','VendorController@fetchVendorName')->name('VendorController.fetchVendorName');
Route::post('vendors/fetchVendorid','VendorController@fetchvendorID')->name('VendorController.fetchvendorID');
Route::post('vendors/update','VendorController@updateVendor');
Route::post('vendors/remove','VendorController@removeVendor');
Route::post('/admin/vendor/editVendor','VendorController@editVendor')->name('VendorController.editVendor');

Route::get('/admin/employees','EmployeeController@index');
Route::post('/admin/employees','EmployeeController@setEmployee')->name('EmployeeController.setEmployee');
Route::post('employees/fetchID','EmployeeController@fetchID')->name('EmployeeController.fetchID');
Route::post('employees/fetchEmployeeName','EmployeeController@fetchEmployeeName')->name('EmployeeController.fetchEmployeeName');
Route::post('employees/fetchNameWhenType','EmployeeController@fetchNameWhenType')->name('EmployeeController.fetchNameWhenType');
Route::post('employees/fetchEmployeeid','EmployeeController@fetchemployeeID')->name('EmployeeController.fetchemployeeID');
Route::post('employees/update','EmployeeController@updateEmployee');
Route::post('/admin/employee/editEmployee','EmployeeController@editEmployee')->name('EmployeeController.editEmployee');
Route::post('employee/remove','EmployeeController@removeEmployee');

Route::post('recipe/storing','RecipeController@store1')->name('RecipeController.store1');
Route::post('recipe/deleting','RecipeController@delete')->name('RecipeController.delete');  


