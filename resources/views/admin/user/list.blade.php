@extends('admin.layouts.master')
@section('title','Category List Page')
{{-- main content --}}
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
               
                    <div class="table-responsive table-responsive-data2">
                      <a href="" class="text-dark"><i class="fa-solid fa-arrow-left-long text-dark"></i>Back</a>
                    
                    
                        <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                              
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone </th>
                               {{-- <th>Address</th> --}}
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                                @foreach ($users as $user)
                                
                                <td class="col-1">
                                    @if($user->image==null)
                                    {{-- <img src="{{asset('image/default-user-image-png.png')}}" class="shadow-sm"/> --}}
                                      @if ($user->gender == 'male')
                                        <img src="{{asset('image/default-user.jpg')}}" class="img-thumbnail shadow-sm">
                                        @else
                                        <img src="{{asset('image/default-female.jpg')}}" class="img-thumbnail shadow-sm">
                                        @endif
                                    @else
                                    <img src="{{asset('storage/'.$user->image)}}" alt="John Doe" />
                                    @endif
                                </td>
                                <input type="hidden" id="userId" value="{{$user->id}}">
                                <td>
                                    {{ $user->name}}
                                </td>
                                <td>
                                    {{ $user->email}}
                                </td>
                                <td>
                                    {{ $user->gender}}
                                </td>
                                <td>
                                    {{ $user->phone}}
                                </td>
                                {{-- <td>
                                    {{ $user->address}}
                                </td> --}}
                                <td>
                                  
                                <select class="form-control statusChange">
                                <option value="admin" @if($user->role =='admin') selected  @endif>Admin</option>
                                <option value="user"  @if($user->role =='user') selected  @endif>User</option>
                                </select>
                                  
                                </td>
                            </tr>
                                @endforeach
                        </tbody>
                    </table>
                  <div class="mt-5">
                    {{$users->links()}}
                  </div>
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
          console.log($currentStatus);
            $parentNode =$(this).parents('tr');
            $userId = $parentNode.find('#userId').val();//data number
            console.log($userId);
            $data = {
                'userId' :$userId,
                'role' :$currentStatus
            };
            // console.log($data);
            $.ajax({
                type :'get',
                url :'http://127.0.0.1:8000/user/change/role',
                data : $data,
                dataType : 'json',
                
            })
           location.reload();
        })
    })
</script>
@endsection