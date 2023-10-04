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
                            <h3 class="text-center title-2"> Update Pizza</h3>
                        </div>
                       
                        <hr>

                        <form action="{{route('product#update')}}" method="post" enctype="multipart/form-data">
                             @csrf
                        <div class="row">
                                    <div class="col-4 offset-1">
                                      
                                        <img src="{{asset('storage/'.$pizza->image)}}" class="shadow-sm"/>
                                        <input type="hidden" name="pizzaId" value="{{$pizza->id}}">
                                        <div class="mt-3">
                                            
                                            <input type="file" name="pizzaImage" id="" class="form-control @error('image')is-invalid @enderror">
                                        @error('pizzaImage')
                                            <div class="invalid-feedback">
                                                {{message}}
                                            </div>
                                        @enderror
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
                            <input id="cc-pament" name="pizzaName" type="text" value="{{old('name',$pizza->name)}}" class="form-control @error('pizzaName') is-invalid @enderror"    aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name.."/>
                             @error('pizzaName')
                                 <div class="invild-feedback">{{$message}}</div>
                             @enderror 
                          
                        </div>

                        <div class="form-group">
                            <label  class="control-label mb-1">Category</label>
                           <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror">
                            <option value="">Choose Your Category </option>
                            @foreach ($category as $c)
                                <option value="{{$c->id}}" @if ($pizza->category_id == $c->id) selected @endif> {{$c->name}}</option>
                            @endforeach
                           </select>
                             @error('pizzaCategory')
                                 <div class="invild-feedback">{{$message}}</div>
                             @enderror 
                          
                        </div>
                        <div class="form-group">
                            <label  class="control-label mb-1">Description</label>
                            <textarea id="cc-pament" name="pizzaDescription" type="text" value="" class="form-control @error('pizzaDescription') is-invalid @enderror"    aria-required="true" aria-invalid="false" placeholder="Enter Description..">{{old('pizzaDescription',$pizza->description)}}</textarea>
                             @error('pizzaDescription')
                                 <div class="invild-feedback">{{$message}}</div>
                             @enderror 
                          
                        </div>
                       

                        <div class="form-group">
                            <label  class="control-label mb-1">Waiting Time</label>
                            <input id="cc-pament" name="pizzaWaitingTime" type="number" value="{{old('pizzaWaitingTime',$pizza->waiting_time)}}" class="form-control @error('pizzaWaitingTime') is-invalid @enderror"    aria-required="true" aria-invalid="false" placeholder="Enter Pizza waiting time"/>
                             @error('pizzaWaitingTime')
                                 <div class="invild-feedback">{{$message}}</div>
                             @enderror 
                          
                        </div>
                        <div class="form-group">
                            <label  class="control-label mb-1">Price</label>
                            <input id="cc-pament" name="pizzaPrice" type="number" value="{{old('pizzaPrice',$pizza->price)}}" class="form-control @error('pizzaPrice') is-invalid @enderror"    aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price"/>
                             @error('pizzaPrice')
                                 <div class="invild-feedback">{{$message}}</div>
                             @enderror 
                          
                        </div>
                   {{-- <div class="form-group">
                        <label  class="control-label mb-1">Address</label>
                        <textarea name="address" placeholder="Enter Address" cols="30 " rows="10" class="form-control @error('address') is-invalid @enderror"> {{old('address',Auth::user()->address)}}</textarea>
                
                        @error('address')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror 
                    </div> --}}
                    <div class="form-group">
                        <label  class="control-label mb-1">View Count</label>
                        <input id="cc-pament" name="role" type="text" value="0" class="form-control @error('role') is-invalid @enderror"   aria-required="true" aria-invalid="false" disabled/>
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