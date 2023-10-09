<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product;
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
        return $data;
    }
}
