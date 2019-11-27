<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//User Controller Operations
Route::post('/login', 'UserController@userLogin');
Route::post('/register', 'UserController@userRegister');
Route::get('/search/userid/{id}', 'UserController@findUserById');
Route::get('/search/useremail/{email}', 'UserController@findUserByEmail');
Route::post('/delete/user/{user}', 'UserController@destroy');
Route::put('/update/user', 'UserController@update');

//Order Controller Operations
Route::resource('/order', "OrderController");
Route::post('/order/addnew', 'OrderController@create');
Route::get('/search/order/{id}', 'OrderController@findOrderById');
Route::delete('/order/delete/{id}', 'OrderController@destroy');    
Route::put('/update/order', 'OrderController@update');
Route::post('/order/store', 'OrderController@store');
Route::get('/search/order/userid/{id}', 'OrderController@findOrderByUserId');

//Pizza Controller Operations 
Route::resource('/pizza', 'PizzaController');
Route::get('/search/pizzaid/{id}', 'PizzaController@findPizzaById');
Route::get('/search/pizzaname/{id}', 'PizzaController@findPizzaByName');
Route::get('/search/pizzacategory/{id}', 'PizzaController@findPizzaByCategoryId');
Route::post('/pizza/store', 'PizzaController@store');
Route::put('/pizza/update', 'PizzaController@update');
Route::delete('/pizza/delete/{id}', 'PizzaController@destroy');    

//Pizza Category Operations
Route::resource('/category', 'PizzaCategoryController');
Route::get('/search/categoryid/{id}', 'PizzaCategoryController@searchByCategoryId');
Route::get('/search/categoryname/{name}', 'PizzaCategoryController@searchByCategoryName');
Route::post('/category/store', 'PizzaCategoryController@store');
Route::put('/category/update', 'PizzaCategoryController@update');
Route::delete('/category/delete/{id}', 'PizzaCategoryController@destroy');    


