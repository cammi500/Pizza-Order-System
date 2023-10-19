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
                            <h2 class="title-1">Category List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('contact#createPage')}}">
                            <button class="au-btn au-btn-icon bg-info au-btn--small">
                                <i class="fa-solid fa-user"> </i>Add Category
                            </button>  
                        </a>
                        <button class="au-btn au-btn-icon bg-info au-btn--small">
                            CSV download
                        </button>  
                    </div>
                </div>
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
                        <form method="get" action="{{route('category#list')}}">
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
                        <h4>Total-</h4>
                    </div>
                </div>
              
             @if (count($contact)!=0)

                    <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Created Date</th>
                               
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($contact as $c)
                                <tr class="tr-shadow">
                                    <td>
                                        {{ $c->id}}
                                    </td>
                                    <td class="col-5">
                                        {{$c->name}}
                                    </td>
                                    <td>
                                        {{$c->created_at->format('j-F-Y')}}
                                    </td>
                                    <td>
                                        <div class="table-data-feature p-2">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                                <i class="zmdi zmdi-mail-send"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button> 
                                             <a href="{{route('c#edit',$c->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="edit">
                                                <i class="zmdi zmdi-more"></i>
                                            </button>
                                        </a>
                                            <a href="{{route('c#delete',$c->id)}}">
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
                    {{-- paginate  --}}
                   <div class="mt-3">
                        {{
                            $contact->appends(request()->query())->links()
                        }}
                    </div>
                </div>
              @else
              
                  <h3 class="text-secondary text-center mt-5">Their is no category</h3>
                  @endif
                <!-- END DATA TABLE -->
            </div>  
        </div>
    </div>
</div>
@endsection