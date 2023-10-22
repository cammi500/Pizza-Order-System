@extends('admin.layouts.master')
@section('title','Category List Page')
{{-- main content --}}
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
            
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
                        <form method="get" action="{{route('admin#contact')}}">
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
                        <h4>Total-{{$contact->total()}}</h4>
                    </div>
                </div>
              
             @if (count($contact)!=0)

                    <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($contact as $c)
                                <tr class="tr-shadow col-2">
                                    <td class="text-center align-items-center">{{$c->id}}</td>
                                    <td>
                                        {{ $c->name}}
                                    </td>
                                    <td class="">
                                        {{$c->email}}
                                    </td>
                                    <td class="col-3">
                                        {{$c->message}}
                                        
                                    </td>
                                    <td>
                                        {{$c->created_at->format('j-F-Y')}}
                                       
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
              
                  <h3 class="text-secondary text-center mt-5">Their is no contact</h3>
                  @endif
                <!-- END DATA TABLE -->
            </div>  
        </div>
    </div>
</div>
@endsection