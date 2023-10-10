<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //return pizza list
    public function pizzaList(Request $request){
        if($request->status == 'desc'){
            $data = Product::orderBy('created_at','desc')->get();
        }else{
            $data = Product::orderBy('created_at','asc')->get();
        }
        return response()->json($data,200);
    }

    // return pizza list
    public function addToCart(Request $request){
        // logger($request->all());
        $data =$this->getOrderData($request);
        Cart::create($data);

        $response = [
            'message' =>'Add to Cart Complete',
            'status' =>'success',
        ];
        return response()->json($response,200);
    }

    // get order data
    private function getOrderData($request){
        return [
            'user_id' => $request->userId,
            'product_id'=>$request->pizzaId,
            'qty'=>$request->count,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];
    }
}
