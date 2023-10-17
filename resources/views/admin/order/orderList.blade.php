@extends('admin.layouts.master')
@section('title','Category List Page')
{{-- main content --}}
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
               
                    <div class="table-responsive table-responsive-data2">
                      <a href="{{route('order#list')}}" class="text-dark"><i class="fa-solid fa-arrow-left-long text-dark"></i>Back</a>
                    
                    <div class="row ">
                        
                       <div class="card mt-4 ">
                        <div class="card-body mt-2">
                            <h3><i class="fa-solid fa-clipboard me-3"></i> Order Info</h3>
                            <small class="text-warning"><i class="fa-solid fa-triangle-exclamation">Include Delivery Charge</i></small>
                        </div>
                        <div class="card-body ">
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-user me-3"></i>Name</div>
                                <div class="col">{{ strtoupper($orderList[0]->user_name)}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-barcode me-3"></i>Order Code</div>
                                <div class="col">{{($orderList[0]->order_code)}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-clock me-3"></i>Order Date</div>
                                <div class="col">{{($orderList[0]->created_at->format('F-j-Y'))}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-money-bill me-3"></i>Total</div>
                                <div class="col">{{($order->total_price)}}kyats</div>
                            </div>
                        </div>
                       </div>
                    </div>
                        <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Order Id</th>
                              
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Order Date </th>
                               <th>Qty</th>
                                <th>Amount</th>
                              
                            </tr>
                        </thead>
                        <tbody id="dataList">
                         @foreach ($orderList as $o)
                        
                         <tr class="tr-shadow">
                          <td></td>
                            <td >
                                {{$o->user_id}}
                            </td>
                            <td >
                              {{$o->product_name}}
                            </td>
                            <td class="col-2">
                                <img  src="{{asset('storage/'.$o->product_image)}}" class="img-thumbnail" >
                            </td>
                            <td>
                                {{$o->product_name}}
                            </td>
                            <td>
                                {{$o->created_at->format('F-j-Y')}}
                            </td>
                            <td >
                                {{$o->qty}}
                            </td>
                            <td>
                                {{$o->total}}
                            </td>
                           
                         </tr>
                         @endforeach 
                        </tbody>
                    </table>
                  
            </div>
        </div>
    </div>
</div>
@endsection

