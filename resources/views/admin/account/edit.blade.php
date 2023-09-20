@extends('admin.layouts.master')
@section('title','Category List Page')
{{-- main content --}}
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            {{-- <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{route('category#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div> --}}
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Profile</h3>
                        </div>
                       
                        <hr>
                        <div class="row">
                    <div class="col-4 offset-1">
                        @if(Auth::user()->image==null)
                        <img src="{{asset('image/default-user-image-png.png')}}" class="shadow-sm"/>
                        @else
                        <img src="{{asset('admin/images/icon/avatar-01.jpg')}}" alt="John Doe" />
                        @endif

                        <div class="mt-3">
                            <input type="file" name="image" id="" class="form-control">
                        </div>
                        <div class="mt-3">
                           <button class="btn bg-dark text-white col-12"type="submit">
                            Update
                           </button>
                        </div>
                    </div>
                    
                    <div class="row col-6">
                       
                        <div class="form-group">
                            <label  class="control-label mb-1">Name</label>
                            <input id="cc-pament" name="name" type="text" value="{{old('name',Auth::user()->name)}}"
                            class="form-control" 
                               aria-required="true" aria-invalid="false" placeholder="Enter name"/>
                         
                       </div>
                       <div class="form-group">
                        <label  class="control-label mb-1">Email</label>
                        <input id="cc-pament" name="email" type="email" value="{{old('email',Auth::user()->email)}}"
                        class="form-control" 
                           aria-required="true" aria-invalid="false" placeholder="Enter email"/>
                     
                   </div>
                   <div class="form-group">
                    <label  class="control-label mb-1">Phone</label>
                    <input id="cc-pament" name="phone" type="text" value="{{old('phone',Auth::user()->phone)}} "
                    class="form-control" 
                       aria-required="true" aria-invalid="false" placeholder="Enter name"/>
                 
               </div>
               <div class="form-group">
                <label  class="control-label mb-1">Address</label>
                <textarea name="address" placeholder="Enter Address" cols="30 " rows="10" class="form-control"> {{old('address',Auth::user()->address)}}</textarea>
               
         
             
           </div>

           <div class="form-group">
            <label  class="control-label mb-1">Role</label>
            <input id="cc-pament" name="role" type="text" value="{{old('role',Auth::user()->role)}}"
            class="form-control" 
               aria-required="true" aria-invalid="false" disabled/>
       </div>
    </div>
      </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection