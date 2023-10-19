<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\OrderList;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    //get all product list
    public function productList(){
        $products =Product::get();
        return response()->json($products,200);
    }
    // localhost:8000/api/product/list

    //get all order List
    public function orderList(){
        $orderList =OrderList::get();
        return response()->json($orderList,200);
    }
    //get all category List
    public function categoryList(){
        $categories =Category::get();
        $users = User::get();
        $data =[
            'category' =>$categories,
            'user' => $users
        ];
        return response()->json($data,200);
    }
}
