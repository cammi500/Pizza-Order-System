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
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create Contact</h3>
                        </div>
                        @if (Session('changeSuccess'))
                        <div class="col-12">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ Session('changeSuccess') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                              </div>
                        </div>
                        @endif
                        <hr>
                        <form action="{{route('contact#create')}}" method="post" novalidate="novalidate">
                           @csrf
                            <div class="form-group">
                                <label  class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="name" type="text"  class="form-control 
                                 {{-- @if(session('notMarch')) is-invalid @endif  --}}
                                 @error('name') is-invalid @enderror"    
                                 aria-required="true" aria-invalid="false" placeholder="Enter Name"/>
                                 @error('name')
                                     <div class="invalid-feedback">{{$message}}</div>
                                 @enderror 
                                 {{-- @if (session('notMatch'))
                                 <div class="invalid-feedback">
                                    {{session('notMatch')}}
                                 </div>
                                     
                                 @endif --}}
                              
                            </div>
                            <div class="form-group">
                                <label  class="control-label mb-1">Email</label>
                                <input id="cc-pament" name="email" type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                   aria-required="true" aria-invalid="false" placeholder="Enter email"/>
                                 @error('email')
                                     <div class="invalid-feedback">{{$message}}</div>
                                 @enderror 
                            </div>
                            <div class="form-group">
                                <label  class="control-label mb-1">Message</label>
                                <textarea id="cc-pament" name="message" type="text" 
                                 class="form-control @error('message') is-invalid @enderror"  
                                   aria-required="true" aria-invalid="false" placeholder="Enter message"></textarea>
                                 @error('message')
                                     <div class="invalid-feedback">{{$message}}</div>
                                 @enderror 
                            </div>
                            
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create contact</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection