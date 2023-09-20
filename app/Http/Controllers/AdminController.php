<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    

    //password validation ckeck
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' =>'required|min:6|max:12',
            'newPassword' =>'required|min:6|max:12',
            'confirmPassword' =>'required|min:6|same:newPassword',
        ])->validate();
    }
}