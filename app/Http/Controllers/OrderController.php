<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
    //sort with ajax
    public function ajaxStatus(Request $request){
        // logger($request->all());
        // $request->status = $request->status ==null ? "" : $request->status;
        $order = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users', 'users.id', 'orders.user_id')
        // ->where('orders.status',$request->status)
        ->orderBy('created_at','desc');
        //query dividend
        if($request->status == null){
            $order = $order->get();
        }else{
            $order = $order->where('orders.status',$request->status)->get();
        }
       
        return response()->json($order,200);
    }
    //ajax change status
    public function ajaxChangeStatus(Request $request){
        // logger($request->all());
        Order::where('id',$request->orderId)->update([
            'status' =>$request->status
        ]);
    }
}
