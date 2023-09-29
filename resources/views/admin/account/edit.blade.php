@extends('admin.layouts.master')
@section('title','Category List Page')
{{-- main content --}}
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Profile</h3>
                        </div>
                       
                        <hr>

                        <form action="{{route('admin#update',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                             @csrf
                        <div class="row">
                                    <div class="col-4 offset-1">
                                        @if(Auth::user()->image==null)
                                        <img src="{{asset('image/default-user-image-png.png')}}" class="shadow-sm"/>
                                        @else
                                        <img src="{{asset('storage/'.Auth::user()->image)}}" alt="John Doe" />
                                        @endif

                                        <div class="mt-3">
                                            <input type="file" name="image" id="" class="form-control">
                                        </div>
                                        <div class="mt-3">
                                        <button class="btn bg-dark text-white col-12" type="submit">
                                            Update
                                        </button>
                                        </div>
                                    </div>
                    
                    <div class="row col-6">

                        <div class="form-group">
                            <label  class="control-label mb-1">Name</label>
                            <input id="cc-pament" name="name" type="text" value="{{old('name',Auth::user()->name)}}" class="form-control @error('name')is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter name"/>
                            @error('name')
                                     <div class="invalid-feedback">{{$message}}</div>
                                 @enderror 
                        </div>
                        <div class="form-group">
                            <label  class="control-label mb-1">Email</label>
                            <input id="cc-pament" name="email" type="email" value="{{old('email',Auth::user()->email)}}" class="form-control @error('email') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter email"/>
                            @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror 
                        </div>
                         <div class="form-group">
                            <label  class="control-label mb-1">Phone</label>
                            <input id="cc-pament" name="phone" type="text" value="{{old('phone',Auth::user()->phone)}} " class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter name"/>
                            @error('phone')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror 
                        </div>
                       <div class="form-group">
                        <label  class="control-label mb-1">Gender</label>
                        <select name="gender" id="" class="form-control">
                            <option>Choose Gender..</option>
                            <option value="male" @if(Auth::user()->gender=='male') selected @endif >Male</option>
                            <option value="female" @if(Auth::user()->gender=='female') selected @endif  >Female</option>
                        </select>
                        @error('gender')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror 
                   </div>
                   <div class="form-group">
                        <label  class="control-label mb-1">Address</label>
                        <textarea name="address" placeholder="Enter Address" cols="30 " rows="10" class="form-control @error('address') is-invalid @enderror"> {{old('address',Auth::user()->address)}}</textarea>
                
                        @error('address')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror 
                    </div>
                <div class="form-group">
                    <label  class="control-label mb-1">Role</label>
                    <input id="cc-pament" name="role" type="text" value="{{old('role',Auth::user()->role)}}" class="form-control @error('role') is-invalid @enderror"   aria-required="true" aria-invalid="false" disabled/>
               </div>
                        </div>
                        </div>
                        </form>

                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection