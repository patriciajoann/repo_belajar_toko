<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\CustomersController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/customers', 'CustomersController@store');
Route::get('/customers', 'CustomersController@show');
Route::put('/customers/{id}', 'CustomersController@update');
Route::delete('/customers/{id}', 'CustomersController@destroy'); 

Route::post('/officers', 'OfficersController@store');
Route::get('/officers', 'OfficersController@show');
Route::put('/officers/{id}', 'OfficersController@update');
Route::delete('/officers/{id}', 'OfficersController@destroy'); 

Route::post('/product', 'ProductController@store');
Route::get('/product', 'ProductController@show');
Route::put('/product/{id}', 'ProductController@update');
Route::delete('/product/{id}', 'ProductController@destroy');

Route::post('/orders', 'OrdersController@store');
Route::get('/orders', 'OrdersController@show');
Route::get('/orders/{id}', 'OrdersController@detail');
Route::put('/orders/{id}', 'OrdersController@update');
Route::delete('/orders/{id}', 'OrdersController@destroy'); 

Route::post('/detail_orders', 'DetailOrdersController@store');
Route::get('/detail_orders', 'DetailOrdersController@show');
Route::get('/detail_orders/{id}', 'DetailOrdersController@detail');
Route::put('/detail_orders/{id}', 'DetailOrdersController@update');
Route::delete('/detail_orders/{id}', 'DetailOrdersController@destroy'); 