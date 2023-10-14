@extends('admin.layouts.master')
@section('title','Category List Page')
{{-- main content --}}
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Product List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="fa-solid fa-user"> </i>Add Product
                            </button>  
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>  
                    </div>
                </div>

                {{-- @if (Session('categorySuccess'))
                <div class="col-3 offset-9">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session('categorySuccess') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                </div>
                @endif --}}

                @if (Session('deleteSuccess'))
                <div class="col-3 offset-9">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ Session('deleteSuccess') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                      </div>
                </div>
                @endif

                <div class="row">
                    <div class="col-3">
                        <h4 class="text-secondary" >Search key: <span class="btn-danger">{{request('key')}}</span></h4>
                    </div>
                    <div class="col-3 offset-6">
                        <form method="get" action="{{route('order#list')}}">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="key"  class="form-control"  placeholder="search..." value="{{request('key')}}">
                            <button  class="btn bg-dark text-white" type="submit">
                                <i class="zmdi zmdi-mail-send"></i>
                            </button>
                            </div>
                        </form>
                       </div>
                </div>
                <div class="row my-2">
                    <div class="col-2 bg-white shadow-sm p-2 my-2 text-center">
                        <h4>Total-{{$order->count()}}</h4>
                    </div>
                </div>
                <div class="d-flex">
                    <label for=""  class="mt-2 me-4">Order Status</label>
                        <select id="orderStatus" name="status" class="form-control col-2">
                            <option value="">All</option>
                            <option value="0">Pending</option>
                            <option value="1">Accept</option>
                            <option value="2">Reject</option>
                        </select>
                </div>
                {{-- @if (count($pizzas)!=0) --}}
                    <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>User Id</th>
                                <th>User Name</th>
                                <th>Order Date </th>
                               <th>Order Code</th>
                                <th>Amount</th>
                                <th>Status</th></th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                         @foreach ($order as $o)
                         <tr class="tr-shadow">
                           
                            <td >
                                {{$o->user_id}}
                            </td>
                            <td >
                                {{$o->user_name}}
                            </td>
                            <td >
                                {{$o->created_at->format('F-j-Y')}}
                            </td>
                            <td >
                               {{$o->order_code}}
                            </td>
                            <td >
                                {{$o->total_price}}kyats
                             </td>
                             <td >
                           <select name="status" class="form-control">
                            <option value="0" @if ($o->status ==0)  selected @endif>Pending</option>
                            <option value="1" @if ($o->status ==1)  selected @endif>Accept</option>
                            <option value="2" @if ($o->status ==2)  selected @endif>Reject</option>
                           </select>
                             </td>
                                </div>
                            </td>
                         </tr>
                         @endforeach 
                        </tbody>
                    </table>
                    {{-- <div class="mt-3">
                        {{$order->links()}}
                    </div> --}}
                   {{-- @else
                </div>
                  <h3 class="text-secondary text-center mt-5">Their is no pizza</h3>
                  @endif --}}
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptSource')
<script>
    $(document).ready(function(){
      
        $('#orderStatus').change(function(){
            $status =$('#orderStatus').val();
            // console.log($status);

            $.ajax({
                type:'get',
                url: 'http://127.0.0.1:8000/order/ajax/status',
                data : {
                    'status': $status
                },
                dataType : 'json',
                success : function(response){
                    //append
                   $list ='';
                   for($i=0;$i<response.length;$i++){


                    //sep-6-2022
                    $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
                   $dbDate =new Date(response[$i].created_at);
                   $finalDate =$months[$dbDate.getMonth()]+"-"+$dbDate.getDate()+"-"+$dbDate.getFullYear();

                //    status
                if(response[$i].status == 0){
                    $statusMessage = `
                    <select name="status" class="form-control">
                           <option value="0" selected>Pending</option>
                           <option value="1"  >Accept</option>
                           <option value="2" >Reject</option>
                          </select>
                    `;
                }else if(response[$i].status == 1){
                    $statusMessage = `
                    <select name="status" class="form-control">
                           <option value="0" >Pending</option>
                           <option value="1" selected >Accept</option>
                           <option value="2" >Reject</option>
                          </select>
                    `;
                }else if(response[$i].status == 2){
                    $statusMessage = `
                    <select name="status" class="form-control">
                           <option value="0" >Pending</option>
                           <option value="1"  >Accept</option>
                           <option value="2"selected >Reject</option>
                          </select>
                    `;
                }
                    $list += `
                    <tr class="tr-shadow">
                           
                           <td >
                               ${response[$i].user_id}
                           </td>
                           <td >
                               ${response[$i].user_name}
                           </td>
                           <td >
                               ${$finalDate}
                           </td>
                           <td >
                              ${response[$i].order_code}
                           </td>
                           <td >
                               ${response[$i].total_price}kyats
                            </td>
                            <td >
                                ${$statusMessage}
                            </td>
                               </div>
                           </td>
                        </tr>
                    `;
                   }
                   $('#dataList').html($list);
                }
            })

        })
    })
</script>
@endsection