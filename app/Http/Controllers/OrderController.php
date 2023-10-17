<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //direct order list
    public function orderList(){
        $order =Order::select('orders.*','users.name as user_name')
        ->leftJoin('users', 'users.id', 'orders.user_id')
        ->orderBy('created_at','desc')
        ->get();
        // dd($order->toArray());
        return view('admin.order.list',compact('order'));
    }
    //click the btn of search
    public function changeStatus(Request $request){
        // dd($request->all());
        // logger($request->all());
        // $request->status = $request->status ==null ? "" : $request->status;
        $order = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users', 'users.id', 'orders.user_id')
        // ->where('orders.status',$request->status)
        ->orderBy('created_at','desc');
        //query dividend
        if($request->orderStatus == null){
            $order = $order->get();
        }else{
            $order = $order->where('orders.status',$request->orderStatus)->get();
        }
       
        return view('admin.order.list',compact('order'));
    }

    //for order code
    public function listInfo($orderCode){
        $order = Order::where('order_code',$orderCode)->first();
        // dd($orderCode);
        $orderList =OrderList::select('order_lists.*','users.name as user_name','products.image as product_image','products.name as product_name')
        ->leftJoin('users','users.id','order_lists.user_id')
        ->leftJoin('products','products.id','order_lists.product_id')
        ->where('order_code',$orderCode)
        ->get();
//    dd($orderList->toArray());
        return view('admin.order.orderList',compact('orderList','order'));
    }


    //ajax change status
    public function ajaxChangeStatus(Request $request){
        // logger($request->all());
        Order::where('id',$request->orderId)->update([
            'status' =>$request->status
        ]);
    }
}
