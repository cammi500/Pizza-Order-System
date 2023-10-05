<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PharIo\Manifest\Email;

class AdminController extends Controller
{
    //change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }
// change password 
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

    // admin detail
    public function details(){
        return view('admin.account.details');
    }
     // admin eidt
     public function edit(){
        
        return view('admin.account.edit');
    }
    public function update($id,Request $request){

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
        return redirect()->route('admin#details')->with(['updateSuccess'=>'Admin Account Created']);
    }


    // admin list show
    public function list(){
        $admin =User::when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%')
                    ->orWhere('email','like','%'.request('key').'%')
                    ->orWhere('gender','like','%'.request('key').'%')
                    ->orWhere('phone','like','%'.request('key').'%')
                    ->orWhere('address','like','%'.request('key').'%');
        })
        ->where('role','admin')->paginate(3);
        // dd($admin->toArray());
        $admin->appends(request()->all);/* searching doing ui not destory */
        return view('admin.account.list',compact('admin'));
    }
    // admin list delete other accounts not mine
    public function delete($id){
        // dd('delete');
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Admin account deleted']);
    }
    


    // change role
        public function changeRole($id){
            $account = User::where('id',$id)->first();
            return view('admin.account.changeRole',compact('account'));
        }
        public function change($id,Request $request){
            $data =$this->requestUserData($request);
            User::where('id',$id)->update($data);
            return  redirect()->route('admin#list');
        }

        // requestUserData
        private function requestUserData($request){
            return[
                'role' =>$request->role
            ];
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