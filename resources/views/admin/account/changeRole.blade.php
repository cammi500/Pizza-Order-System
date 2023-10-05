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
                        <div class="">
                            {{-- <a href="{{route('product#list')}}" class="text-decoration-none"> --}}
                              <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                              
                          </div>
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Role</h3>
                        </div>
                       
                        <hr>

                        <form action="{{route('admin#change',$account->id)}}" method="post" enctype="multipart/form-data">
                             @csrf
                        <div class="row">
                                    <div class="col-4 offset-1">
                                        @if($account->image==null)
                                        {{-- <img src="{{asset('image/default-user-image-png.png')}}" class="shadow-sm"/> --}}
                                          @if ($account->gender == 'male')
                                            <img src="{{asset('image/default-user.jpg')}}" class="img-thumbnail shadow-sm">
                                            @else
                                            <img src="{{asset('image/default-female.jpg')}}" class="img-thumbnail shadow-sm">
                                            @endif
                                        @else
                                        <img src="{{asset('storage/'.$account->image)}}" alt="John Doe" />
                                        @endif

                                        {{-- <div class="mt-3">
                                            <input type="file" name="image" id="" class="form-control @error('image')is-invalid @enderror">
                                        </div> --}}
                                        <div class="mt-3">
                                        <button class="btn bg-dark text-white col-12" type="submit">
                                            Update
                                        </button>
                                        </div>
                                    </div>
                    
                    <div class="row col-6">

                        <div class="form-group">
                            <label  class="control-label mb-1">Name</label>
                            <input  disabled id="cc-pament" name="name" type="text" value="{{old('name',$account->name)}}" class="form-control @error('name')is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter name"/>
                            
                        </div>
                        <div class="form-group">
                            <label  class="control-label mb-1">Email</label>
                            <input disabled  id="cc-pament" name="email" type="email" value="{{old('email',$account->email)}}" class="form-control @error('email') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter email"/>
                           
                        </div>
                         <div class="form-group">
                            <label  class="control-label mb-1">Phone</label>
                            <input  disabled id="cc-pament" name="phone" type="text" value="{{old('phone',$account->phone)}} " class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter name"/>
                          
                        </div>
                       <div class="form-group">
                        <label  class="control-label mb-1">Gender</label>
                        <select  disabled name="gender" id="" class="form-control">
                            <option>Choose Gender..</option>
                            <option value="male" @if($account->gender=='male') selected @endif >Male</option>
                            <option value="female" @if($account->gender=='female') selected @endif  >Female</option>
                        </select>
                        
                   </div>
                   <div class="form-group">
                        <label  class="control-label mb-1">Address</label>
                        <textarea  disabled name="address" placeholder="Enter Address" cols="30 " rows="10" class="form-control @error('address') is-invalid @enderror"> {{old('address',$account->address)}}</textarea>
                
                       
                    </div>
                <div class="form-group">
                    <label  class="control-label mb-1">Role</label>
                    <select id="cc-pament" name="role"  class="form-control @error('role') is-invalid @enderror"   aria-required="true" aria-invalid="false" >
                    <option value="admin" @if($account->role =='admin') selected  @endif>Admin</option>
                    <option value="user"  @if($account->role =='user') selected  @endif>User</option>
                    </select>
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