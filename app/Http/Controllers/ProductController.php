<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{   //product list
    public function list(){
        $pizzas = Product::select('products.*','categories.name as category_name')
        ->when(request('key'),function($query){
            $query ->where('product.name','like','%'.request('key'). '%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')
        ->paginate(2);
        $pizzas->appends(request()->all());
        return view('admin.product.pizzaList',compact('pizzas'));
    }
    // direct pizza create page
    public function createPage(){
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.create',compact('categories'));
    }
    // product validation check
    public function create(Request $request){
        $this->productValidationCheck($request,"create");
        $data =$this->requestProductInfo($request);
         

        // image
        // if($request->hasFile('pizzaImage')){
            $filename=uniqid().$request->file('pizzaImage')->getClientOriginalName();/*project store*/
            $request->file('pizzaImage')->storeAs('public',$filename);/*database store*/
            $data['image']=$filename;
        // }
        Product::create($data);
        return redirect()->route('product#list');
    }
    // edit pizza
    public function edit($id){
        $pizza =Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();
        return view('admin.product.edit',compact('pizza'));
    }
    // update
    public function updatePage($id){
        $pizza =Product::where( 'id',$id)->first();
        $category =Category::get();
        return view('admin.product.update',compact('pizza','category'));
    }

    // update
    public function update(Request $request){
        $this->productValidationCheck($request,"update");
        $data =$this->requestProductInfo($request);
        // dd($data);

        // old delete
        if($request->hasFile('pizzaImage')){
            $oldImageName =Product::where('id',$request->pizzaId)->first();
            $oldImageName = $oldImageName->image;
            // storage delete
            if($oldImageName != null){
                Storage::delete('public/'.$oldImageName);
            }
            // new photo
            $filename =uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public', $filename);
            $data['image'] = $filename;
        }
        // update
        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#list');
    }
    // delete

    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess'=>'Pizza delete Success']);
    }

   
    // request product info check
    private function requestProductInfo($request){
        return [
            'category_id' =>$request->pizzaCategory,
            'name' =>$request->pizzaName,
            'description' =>$request->pizzaDescription,
            'waiting_time' =>$request->pizzaWaitingTime,
            'price' =>$request->pizzaPrice
        ];
    }

    // Product validation check
    private function productValidationCheck($request,$action ){

        $validationRules = [
                'pizzaName' => 'required|min:5|unique:products,name,'.$request->pizzaId,
                'pizzaCategory' => 'required',
                'pizzaDescription' => 'required|min:10',
                // 'pizzaImage' => 'required|mimes:jpg,jpeg,png',
                'pizzaWaitingTime' => 'required',
                'pizzaPrice' => 'required',
            ];
        $validationRules['pizzaImage'] = $action == "create" ? 'required|mimes:jpg,jpeg,png,webp' : 'mimes:jpg,jpeg,png,webp' ;
           Validator::make($request->all(),$validationRules)->validate();
    }
}
