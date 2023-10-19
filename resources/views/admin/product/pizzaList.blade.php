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
                        <a href="{{route('product#createPage')}}">
                            <button class="au-btn au-btn-icon bg-info au-btn--small">
                                <i class="fa-solid fa-user"> </i>Add Product
                            </button>  
                        </a>
                        <button class="au-btn au-btn-icon bg-info au-btn--small">
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
                        <form method="get" action="{{route('product#list')}}">
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
                        <h4>Total-{{$pizzas->total()}}</h4>
                    </div>
                </div>
                @if (count($pizzas)!=0)
                    <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                               
                                <th>Category</th>
                                <th>View count</th>
                            </tr>
                        </thead>
                        <tbody>

                         @foreach ($pizzas as $p)
                         <tr class="tr-shadow">
                            <td>
                                <img src="{{ asset('storage/'.$p->image)}}" class="img-thumbnail shadow-sm" >

                            </td>
                            <td class="col-2">
                                {{$p->name}}
                            </td>
                            <td class="col-2">
                                {{$p->price}}
                            </td>
                            <td class="col-2">
                                {{$p->category_name}}
                            </td>
                            <td class="col-2">
                                <i class="fa-solid fa-eye"></i>  {{$p->view_count}}
                            </td>
                            <td class="col-2">
                                <div class="table-data-feature p-2">
                                    {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                        <i class="zmdi zmdi-mail-send"></i>
                                    {{-- </button> --}}
                                    <a href="{{route('product#edit',$p->id)}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="view">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button> 
                                    </a>
                                    <a href="{{route('product#updatePage',$p->id)}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="edit">
                                        <i class="zmdi zmdi-more"></i>
                                    </button>
                                </a>
                                    <a href="{{route('product#delete',$p->id)}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </a>
                                        
                                  
                                </div>
                            </td>
                        </tr>
                         @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{$pizzas->links()}}
                    </div>
                   @else
                </div>
                  <h3 class="text-secondary text-center mt-5">Their is no product</h3>
                  @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection