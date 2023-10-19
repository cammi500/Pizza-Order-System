@extends('admin.layouts.master')
@section('title','Category List Page')
{{-- main content --}}
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
           
                <form action="{{route('admin#changeStatus')}}" method="get">
                    @csrf
                    <div class="input-group mb-3">
                   <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="fa-solid fa-database mr-2"></i>{{count($order)}}
                    </span>
                   </div>
                        <select name="orderStatus" class="custom-select form-control col-2">
                            <option value="">All</option>
                            <option value="0" @if(request('orderStatus') =='0') selected @endif >Pending</option>
                            <option value="1" @if(request('orderStatus') == '1')  selected @endif >Accept</option>
                            <option value="2" @if(request('orderStatus') == '2')  selected @endif >Reject</option>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm bg-dark ms-3 text-white input-group-text"><i class="fa-solid fa-magnifying-glass me-2"></i> Search</button>
                        </div>
                </div>
                </form>
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
                            <input type="hidden" name="" class="orderId" value="{{$o->id}}">
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
                               <a href="{{route('admin#listInfo',$o->order_code)}}" >{{$o->order_code}}
                            </td>
                            <td class="amount">
                                {{$o->total_price}}kyats
                             </td>
                             <td >
                           <select name="status" class="form-control statusChange">
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
                  @endif  --}}
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptSource')
<script>

    
    $(document).ready(function(){
      
    //     $('#orderStatus').change(function(){
    //         $status =$('#orderStatus').val();
    //         // console.log($status);

    //         $.ajax({
    //             type:'get',
    //             url: 'http://127.0.0.1:8000/order/ajax/status',
    //             data : {
    //                 'status': $status
    //             },
    //             dataType : 'json',
    //             success : function(response){
    //                 //append
    //                $list ='';
    //                for($i=0;$i<response.length;$i++){


    //                 //sep-6-2022
    //                 $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    //                $dbDate =new Date(response[$i].created_at);
    //                $finalDate =$months[$dbDate.getMonth()]+"-"+$dbDate.getDate()+"-"+$dbDate.getFullYear();

    //             //    status
    //             if(response[$i].status == 0){
    //                 $statusMessage = `
    //                 <select name="status" class="form-control statusChange">
    //                        <option value="0" selected>Pending</option>
    //                        <option value="1"  >Accept</option>
    //                        <option value="2" >Reject</option>
    //                       </select>
    //                 `;
    //             }else if(response[$i].status == 1){
    //                 $statusMessage = `
    //                 <select name="status" class="form-control statusChange">
    //                        <option value="0" >Pending</option>
    //                        <option value="1" selected >Accept</option>
    //                        <option value="2" >Reject</option>
    //                       </select>
    //                 `;
    //             }else if(response[$i].status == 2){
                    
    //                 $statusMessage = `
    //                 <select name="status" class="form-control statusChange">
    //                        <option value="0" >Pending</option>
    //                        <option value="1"  >Accept</option>
    //                        <option value="2"selected >Reject</option>
    //                       </select>
    //                 `;
    //             }
    //                 $list += `
    //                 <tr class="tr-shadow">
    //                     <input type="hidden" name="" class="orderId" value=" ${response[$i].id}">
    //                        <td >
    //                            ${response[$i].user_id}
    //                        </td>
    //                        <td >
    //                            ${response[$i].user_name} || ${response[$i].id}
    //                        </td>
    //                        <td >
    //                            ${$finalDate}
    //                        </td>
    //                        <td >
    //                           ${response[$i].order_code}
    //                        </td>
    //                        <td >
    //                            ${response[$i].total_price}kyats
    //                         </td>
    //                         <td >
    //                             ${$statusMessage}
    //                         </td>
    //                            </div>
    //                        </td>
    //                     </tr>
    //                 `;
    //                }
    //                $('#dataList').html($list);
    //             }
    //         })

    //     })

        //change status of db
        $('.statusChange').change(function (){
          $currentStatus = $(this).val();//val 
        //   console.log($currentStatus);
            $parentNode =$(this).parents('tr');
            $orderId = $parentNode.find('.orderId').val();//data number
            // console.log($orderId);
            $data = {
                'orderId' :$orderId,
                'status' :$currentStatus
                

            };
            // console.log($data);
            $.ajax({
                type :'get',
                url :'/order/ajax/change/status',
                data : $data,
                dataType : 'json',
                
            })
            // window.location.href = '/order/orderList';
        })
    })
</script>
@endsection