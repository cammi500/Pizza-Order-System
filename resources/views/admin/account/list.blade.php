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
                        <h4>Total-{{$admin->total()}}</h4>
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
                                <th>Address</th>
                                <th>

                                </th>
                            </tr>
                        </thead>
                         <tbody>
                            
                            @foreach ($admin as $a)
                                <tr class="tr-shadow">
                                    <td class="col-2">
                                        @if ($a->image == null)
                                            {{-- <img src="{{asset('image/default-user.jpg')}}" class="img-thumbnail shadow-sm"> --}}
                                            @if ($a->gender == 'male')
                                            <img src="{{asset('image/default-user.jpg')}}" class="img-thumbnail shadow-sm">
                                            @else
                                            <img src="{{asset('image/default-female.jpg')}}" class="img-thumbnail shadow-sm">
                                            @endif
                                        @else
                                            <img src="{{asset('storage/'.$a->image)}}" class="img-thumbnail shadow-sm" >        
                                             @endif
                                    </td>
                                    <td class="col-5">
                                        {{$a->name}}
                                    </td>
                                    <td>
                                        {{$a->email}}
                                    </td>
                                    <td>
                                        {{$a->gender}}
                                    </td>
                                    <td>
                                        {{$a->phone}}
                                    </td>
                                    <td>
                                        {{$a->address}}
                                    </td>
                                     <td>
                                        <div class="table-data-feature p-2">
                                           @if (Auth::user()->id == $a->id)
                                               
                                           @else
                                           <a href="{{route('admin#changeRole',$a->id)}}">
                                            <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Change Roles">
                                                <i class="fa-solid fa-person-circle-minus"></i>
                                            </button>
                                        </a>
                                        <a href="{{route('admin#delete',$a->id)}}">
                                            <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </a>
                                           @endif
                                            
                                        </div>
                                 
                                </tr>
                            @endforeach

                            
                         </tbody> 
                    </table>
                    {{-- paginate --}}
                    <div class="mt-3">
                        {{
                            $admin->appends(request()->query())->links()
                        }}
                    </div>
                </div>
              
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection