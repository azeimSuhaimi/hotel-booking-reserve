@extends('layouts.app')
 
@section('title', 'Page Title')
@section('content')
    
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">All Room Type</li>
                </ol>
            </div>
            <h4 class="page-title">All Room Type</h4>
        </div>
    </div>
</div>     
<!-- end page title --> 



<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title"></h4>
                <p class="sub-header">
                    
                </p>

                <div class="mb-2">
                    <div class="row row-cols-sm-auto g-2 align-items-center">
                        <div class="col-12 text-sm-center">
                            <select id="demo-foo-filter-status" class="form-select form-select-sm">
                                <option value="">Show all</option>
                                <option value="active">Active</option>
                                <option value="disabled">Disabled</option>
                                <option value="suspended">Suspended</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
                        </div>
                        <div class="col-12">
                            <a class="btn btn-primary" href="{{route('add.roomtype')}}">add RoomType</a>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
                        <thead>
                        <tr>
                            <th data-toggle="true"> Name</th>
                            <th data-hide="phone, tablet">#</th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach ($roomtype as $row)
                                <tr>
                                    <td>{{$row->name}}</td>
                                    <td>
                                        <div class="btn-group mb-2">
                                            <a onclick="confirmAndRedirect(this)" href={{route('delete.team').'?id='.$row->id}}" class="btn btn-danger">delete</a>
                                            <a  href={{route('edit.team',['id' => $row->id])}}" class="btn btn-primary">Edit</a>
                                            <button type="button" class="btn btn-light">Right</button>
                                        </div>
                                    </td>
                                </tr> 
                            @endforeach

                        </tbody>
                        <tfoot>
                        <tr class="active">
                            <td colspan="5">
                                <div class="text-end">
                                    <ul class="pagination pagination-rounded justify-content-end footable-pagination mb-0"></ul>
                                </div>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div> <!-- end .table-responsive-->
            </div>
        </div> <!-- end card -->
    </div> <!-- end col -->
</div>
<!-- end row -->



@endsection