@extends('user.layouts.master')

@section('content')
    <div class="row">
        <div class="col-6 offset-3">
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class=" offset-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Change Password</h3>
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
                                    <form action="{{route('user#changePassword')}}" method="post" novalidate="novalidate">
                                       
                                       @csrf
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Old Password</label>
                                            <input id="cc-pament" name="oldPassword" type="password"  class="form-control 
                                             @if(session('notMarch')) is-invalid @endif 
                                             @error('oldPassword') is-invalid @enderror"    
                                             aria-required="true" aria-invalid="false" placeholder="Enter Old Password"/>
                                             @error('oldPassword')
                                                 <div class="invalid-feedback">{{$message}}</div>
                                             @enderror 
                                             @if (session('notMatch'))
                                             <div class="invalid-feedback">
                                                {{session('notMatch')}}
                                             </div>
                                                 
                                             @endif
                                          
                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">New Password</label>
                                            <input id="cc-pament" name="newPassword" type="password" 
                                            class="form-control @error('newPassword') is-invalid @enderror" 
                                               aria-required="true" aria-invalid="false" placeholder="Enter New Password"/>
                                             @error('newPassword')
                                                 <div class="invalid-feedback">{{$message}}</div>
                                             @enderror 
                                          
                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Comfirm Password</label>
                                            <input id="cc-pament" name="confirmPassword" type="password" 
                                             class="form-control @error('confirmPassword') is-invalid @enderror"  
                                               aria-required="true" aria-invalid="false" placeholder="Enter Comfirm Password"/>
                                             @error('confirmPassword')
                                                 <div class="invalid-feedback">{{$message}}</div>
                                             @enderror 
                                          
                                        </div>
                                        
                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-warning btn-block">
                                                <span id="payment-button-amount">Change password</span>
                                                {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
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
        </div>
    </div>
@endsection