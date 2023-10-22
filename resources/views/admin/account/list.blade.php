@extends('admin.layouts.master')
@section('title','Category List Page')
{{-- main content --}}
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                {{-- <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Category List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="fa-solid fa-user"> </i>Add Category
                            </button>  
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>  
                    </div>
                </div> --}}

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
                        <form method="get" action="{{route('admin#list')}}">
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
                        <h4>Total-{{$admins->total()}}</h4>
                    </div>
                </div>
              
          

                    <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th> Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                {{-- <th>Address</th> --}}
                                <th>

                                </th>
                            </tr>
                        </thead>
                         <tbody>
                            
                            @foreach ($admins as $admin)
                                <tr class="tr-shadow">
                                    <td class="col-2">
                                        @if ($admin->image == null)
                                            {{-- <img src="{{asset('image/default-user.jpg')}}" class="img-thumbnail shadow-sm"> --}}
                                            @if ($admin->gender == 'male')
                                            <img src="{{asset('image/default-user.jpg')}}" class="img-thumbnail shadow-sm">
                                            @else
                                            <img src="{{asset('image/default-female.jpg')}}" class="img-thumbnail shadow-sm">
                                            @endif
                                        @else
                                            <img src="{{asset('storage/'.$admin->image)}}" class="img-thumbnail shadow-sm" >        
                                             @endif
                                    </td>
                                    <input type="hidden" id="adminId" value="{{$admin->id}}">
                                    <td class="">
                                        {{$admin->name}}
                                    </td>
                                    <td>
                                        {{$admin->email}}
                                    </td>
                                    <td>
                                        {{$admin->gender}}
                                    </td>
                                    <td>
                                        {{$admin->phone}}
                                    </td>
                                    {{-- <td>
                                        {{$admin->address}}
                                    </td> --}}
                                     <td class="col-5">
                                        <div class="table-data-feature p-2">
                                           @if (Auth::user()->id == $admin->id)
                                               
                                           @else
                                           {{-- <a href="{{route('admin#changeRole',$admin->id)}}">
                                            <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Change Roles">
                                                <i class="fa-solid fa-person-circle-minus"></i>
                                            </button> 
                                            </a> --}}
                                           <div class="mr-3">
                                                <select class="form-control statusChange">
                                                <option value="admin" @if($admin->role =='admin') selected  @endif>Admin</option>
                                                <option value="user"  @if($admin->role =='user') selected  @endif>User</option>
                                                </select>
                                            </div>
                                        
                                        <div class="">
                                            <a href="{{route('admin#delete',$admin->id)}}">
                                                <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>
                                        </div>
                                           @endif
                                            
                                        </div>
                                     </td>
                                </tr>
                            @endforeach

                            
                         </tbody> 
                    </table>
                    {{-- paginate --}}
                    <div class="mt-3">
                        {{
                            $admins->appends(request()->query())->links()
                        }}
                    </div>
                </div>
              
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptSource')
<script>

    
     $(document).ready(function(){
        //change status of db
        $('.statusChange').change(function (){
          $currentStatus = $(this).val();//val 
        //   console.log($currentStatus);
            $parentNode =$(this).parents('tr');
            $adminId = $parentNode.find('#adminId').val();//data number
            // console.log($adminId);
            $data = {
                'adminId' :$adminId,
                'role' :$currentStatus
            };
            // console.log($data);
            $.ajax({
                type :'get',
                url :'http://127.0.0.1:8000/admin/changeRole',
                data : $data,
                dataType : 'json',
                
            })
           location.reload();
        })
    })
</script>
@endsection

