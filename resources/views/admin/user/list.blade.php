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
                               <th>Address</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                                @foreach ($users as $user)
                            <>
                                <td>
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
                                <td>
                                    {{ $user->address}}
                                </td>
                                <td>
                                    <div class="form-group">
                                        
                                        <select id="cc-pament" name="role"  class="form-control @error('role') is-invalid @enderror"   aria-required="true" aria-invalid="false" >
                                        <option value="admin" @if($user->role =='admin') selected  @endif>Admin</option>
                                        <option value="user"  @if($user->role =='user') selected  @endif>User</option>
                                        </select>
                                   </div>
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