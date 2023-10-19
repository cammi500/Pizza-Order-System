<?php

use App\Http\Controllers\api\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('apiTesting',function(){
// $data = [
//     'message' => 'this is my api message',
// ];
// return response()->json($data,200);
// });

//get product
Route::get('product/list',[RouteController::class,'productList']);
//get category
Route::get('category/list',[RouteController::class,'categoryList']);
//get order
Route::get('order/list',[RouteController::class,'orderList']);