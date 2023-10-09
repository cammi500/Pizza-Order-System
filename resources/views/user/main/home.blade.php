
@extends('user.layouts.master')
@section('content')
     <!-- Shop Start -->
     <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class=" d-flex align-items-center justify-content-between mb-3 bg-dark text-white px-2">
                          
                            <label class="mt-2" for="price-all">Category</label>
                            <span class="badge border font-weight-normal">{{count($category)}}</span>
                        </div>
                      @foreach ($category as $c)
                      <div class=" d-flex align-items-center justify-content-between  shadow-sm mb-3">
                        
                        <label class="mt-2" for="price-all">{{$c->name}}</label>
                        
                    </div>
                      @endforeach
                    </form>
                </div>
                <!-- Price End -->
                
               
                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">

                                   <select name="sorting" id="sortingOption" class="form-control">
                                    <option value="">Choose Option ..</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Decending</option>
                                   </select>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                       <span class="row" id="dataList">
                        @foreach ($pizza as $p)  
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1 " >
                            <div class="product-item bg-light mb-4" id="myForm">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100 " style="height: 200px" src="{{asset('storage/'.$p->image)}}" alt="">
                                   <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                       
                                    </div> 
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{$p->price}}</h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                       </span>
                   
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection
@section('scriptSource')
    <script>
        // $(document).ready(function(){
        //  $.ajax({
        //     type : 'get',
        //     url : 'http://127.0.0.1:8000/user/ajax/pizza/list',
        //     datatype: 'json',
        //     success: function(response){
        //         console.log(response);
        //     }
        //  })
        // });
             $('#sortingOption').change(function(){
            $eventOption =$('#sortingOption').val();
            // console.log($eventOption);

            if($eventOption =='asc'){
                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/user/ajax/pizza/list',
                    data : {'status' :'asc'},
                    datatype: 'json',
                    success: function(response){
                        // console.log(response[0]->name);
                        $list = '';
                        for($i=0;$i<response.length;$i++) {
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1 " >
                            <div class="product-item bg-light mb-4" id="myForm">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100 " style="height: 200px" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                   <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                       
                                    </div> 
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price}</h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                            `;
                    
                }
                $('#dataList').html($list);
                // console.log($list);
            }
                })
                // console.log('lifo')
            }else if($eventOption =='desc'){
                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/user/ajax/pizza/list',
                    data : {'status' :'desc'},
                    datatype: 'json',
                    success: function(response){
                        $list = '';
                        for($i=0;$i<response.length;$i++) {
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1 " >
                            <div class="product-item bg-light mb-4" id="myForm">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100 " style="height: 200px" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                   <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                       
                                    </div> 
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price}</h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                            `;
                    
                }
                $('#dataList').html($list);
                // console.log($list);
            
                        // console.log(response);
                    }
                })
            }
             })
    </script>
@endsection