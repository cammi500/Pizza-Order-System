<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function home(){
        $pizza = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }
    // change Password page
    public function changePasswordPage(){
        return view('user.password.change');
    }
    // change Password 
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);

        $user =User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashValue=$user->password;
        
        if(Hash::check($request->oldPassword, $dbHashValue)){
            $data =[
                'password' =>Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
        
            // Auth::logout();
            // return redirect()->route('auth#loginPage')
            // ;
            return back()->with(['changeSuccess'=>'Password Change Success']);
        }
        return back()->with(['notMatch'=>'old password not Match.Try Again']);
    }
    // filer category
    public function filter($categoryId){
        // dd($categoryId);
        $pizza = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }
    //history
    public function history(){
        $order =Order::where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->paginate('3');
        return view('user.main.history',compact('order'));
    }
    // account change
    public function accountChangePage(){
        return view('user.profile.account');
    }
    // account change for update
    public function accountChange($id,Request $request){
        $this->accountValidationCheck($request);
        $data=$this->getUserData($request);
         //image
         if ($request->hasFile('image')){
            $dbImage =User::where('id',$id)->first();
            $dbImage =$dbImage->image;
           if($dbImage!=null){
            Storage::delete('public/'.$dbImage);
           }
         }
         $filename =uniqid().$request->file('image')->getClientOriginalName();
         $request->file('image')->storeAs('public',$filename);
         $data['image'] =$filename;
        
        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess'=>'Admin Account Created']);
        // return view('user.profile.account');
    }
        // direct pizza details
        public function pizzaDetails($pizzaId){
            $pizza = Product::where('Id',$pizzaId)->first();
            $pizzaList =Product::get();
            return view('user.main.detail',compact('pizza','pizzaList'));
        } 

        public function cartList(){
            $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as product_image')  
                            ->leftJoin('products','products.id','carts.product_id')
                            ->where('carts.user_id',Auth::user()->id)
                            ->get();
            // dd($cartList->toArray());
            $totalPrice =0;
            foreach($cartList as $c){
                $totalPrice += $c->pizza_price * $c->qty;
            }

            return view('user.main.cart',compact('cartList','totalPrice'));
        }

// user list in admin adshboard
        public function userList(){
            $users =User::where('role','user')->paginate('3');
            return view('admin.user.list',compact('users'));
        }
//change user role
        public function userChangeRole(Request $request){
            // logger($request->all());
            $updateSource =[
                'role' =>$request->role
            ];
            User::where('id',$request->userId)->update($updateSource);
        }



     //request user 
  private function getUserData($request){
    return [
        'name' => $request->name,
        'email' => $request->email,
        'gender' => $request->gender,
        'phone' => $request->phone,
        'address' => $request->address,
        'updated_at' => Carbon::now()
    ];
  }
  //account validation check
  private function accountValidationCheck($request){
    Validator::make($request->all(),[
        'name' =>  'required',
        'email' => 'required',
        'gender' => 'required',
        'phone' => 'required',
        'image' => 'mimes:png,jpg,jpeg,gif',
        'address' => 'required',
        ])->validate();
  }
        //password validation ckeck
        private function passwordValidationCheck($request){
            Validator::make($request->all(),[
                'oldPassword' =>'required|min:6|max:12',
                'newPassword' =>'required|min:6|max:12',
                'confirmPassword' =>'required|min:6|same:newPassword',
            ])->validate();
        }
}
