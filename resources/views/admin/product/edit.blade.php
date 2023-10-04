@extends('admin.layouts.master')
@section('title','Category List Page')
{{-- main content --}}
@section('content')
<div class="main-content">

    <div class="row">
        <div class="col-3 offset-7 mb-2">
            @if(session('updateSucccess'))
            <div class="">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-xmark"></i>{{session('updateSuccess')}}
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>               </div>
                </div>
            </div>
            @endif
        </div>
    </div>
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
                        <div class="">
                          {{-- <a href="{{route('product#list')}}" class="text-decoration-none"> --}}
                            <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                            
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2">Pizza Details</h3>
                        </div>
                       
                        <hr>
                        <div class="row">
                            <div class="col-3 offset-2">
                                <img src="{{ asset('storage/'.$pizza->image)}}" class="img-thumbnail shadow-sm" >

                            </div>
                            <div class="col-7 ">
                                <div class="my-3 btn bg-danger text-white w-50 text-center d-block"><i class="fa-solid fs-5  fa-note-sticky me-5"></i>{{$pizza->name}}</div>
                                <span class="my-3 btn bg-dark text-white"><i class="fa-solid fs-5 fa-money-bill-1-wave me-2"></i>{{$pizza->price}}kyats</span>
                                <span class="my-3 btn bg-dark text-white"><i class="fa-solid fs-5 fa-clock me-2"></i>{{$pizza->waiting_time}}mins</span>
                                <span class="my-3 btn bg-dark text-white"><i class="fa-solid fs-5 fa-eye me-2"></i>{{$pizza->view_count}}</span>
                                <span class="my-3 btn bg-dark text-white"><i class="fa-solid fs-5 fa-file-lines me-2"></i>{{$pizza->description}}</span>
                                <span class="my-3 btn bg-dark text-white"><i class="fa-solid fs-5 fa-user-clock me-2"></i>{{$pizza->created_at->format('j-F-Y')}}</span>

                            </div>
                           
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection