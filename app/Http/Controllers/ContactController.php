<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //show
    public function contact(){
        $contact =Contact::when(request('key'),function($query){
            $query->where('name','LIKE', '%' . request('key' ). '%');
        }) ->orderBy('id','desc')
         ->paginate(4);
        // $contact = Contact::orderby('created_at', 'desc')->get();
        return view('admin.contact.show',compact('contact'));
    }
    public function createPage(){
        return view('admin.contact.create');
    }
     //create category
     public function create(Request $request){
        // dd($request->all());
        $this->contactValidationCheck($request);
        $data = $this->requestContactData($request);
        
        Contact::create($data);
        // dd($data);
        return redirect()->route('admin#contact');
     }
     private function contactValidationCheck($request){
        $validationRules = [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ];
       Validator::make($request->all(),$validationRules)->validate();
     }
     //request category data
    private function requestContactData($request){
        return[
            'name' =>$request->name,
            'email' =>$request->email,
            'message' =>$request->message
        ];
    }
}
