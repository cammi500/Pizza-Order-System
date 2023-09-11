<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //direct login page
    public function loginPage(){
        return view('login');
    }
        //direct login page
    public function registerPage(){
        return view('register');
    }
        //direct dashboard 
    public function dashboard(){
            if(Auth::user()->role=='admin'){
                return redirect()->route('category#list');
            }
            return redirect()->route('user#home'); 
        }
    //change password page
    public function changePasswordPage(){
        return view('admin.password.change');
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
        
            Auth::logout();
            return redirect()->route('auth#loginPage');
        }
        return back()->with(['notMatch'=>'old password not Match.Try Again']);
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