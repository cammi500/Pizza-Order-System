<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\OrderList;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
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
        $categories =Category::orderBy('id','desc')->get();
        $users = User::get();
        $data =[
            'category' =>$categories,
            'user' => $users
        ];
        return response()->json($data,200);
    }

    //post create category
    public function categoryCreate(Request $request){
        // dd($request->all());
        $data =[
            'name'=>$request->name,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];
        // return $data;
         $response = Category::create($data);
        return response()->json($response,200);
    }
    //post create contact
    public function contactCreate(Request $request){
        // dd($request->all());
        $data =$this->getContactData($request);
        Contact::create($data);
        $contact = Contact::orderBy('created_at','desc')->get();
        return response()->json($contact,200);
    }//get contact data
    private function getContactData( $request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    //post delete request for category
    public function categoryDelete(Request $request){
        $data = Category::where('id', $request->category_id)->first();
        // dd(isset($data));
        //yes no sise
        if(isset($data)){
            Category::where('id',$request->category_id)->delete();
            return response()->json(['status'=> true ,'message'=>"delete success"],200);
        }
        return response()->json(['status'=> false ,'message'=>"There was no category"],200);
        // return $request->all();
      
    }

    //get delete request for category
    public function Delete($id){
        $data = Category::where('id', $id)->first();
        // dd(isset($data));
       
        if(isset($data)){
            Category::where('id',$id)->delete();
            return response()->json(['status'=> true ,'message'=>"delete success","deleteData" => $data],200);
        }
        return response()->json(['status'=> false ,'message'=>"There was no category"],200);
        // return $request->all();
      
    }
}
