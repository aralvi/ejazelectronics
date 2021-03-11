@extends('layouts.admin') @section('title','Categories | ') @section('content')
<!-- CONTAINER FLUID -->
<div class="container-fluid">
    <!-- ROW 1 -->
    <div class="row">
        <div class="col-md-6">
            <h2 style="margin-top: 4px;">List of Categories <small>({{ $total }})</small></h2>
        </div>
        <div class="col-md-6">
            <button title="Click to Add Category" data-toggle="modal" data-target="#addCatModal" class="btn btn-primary btn-sm" style="float: right;"><i class="fas fa-plus"></i> Add Category</button>
        </div>
    </div>
    <!-- END ROW 1 -->
    <br />

    <div class="card">
        <div class="card-body">
            <div class="table-responsive catTableData" id="catTableData">
                <table id="table-search" class="table table-hover">
                    <thead>
                        <tr class="text-uppercase">
                            <th scope="col">#</th>
                            <th scope="col">user</th>
                            <th scope="col">Category</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $key => $category)
                        <tr id="target_{{ $category->id }}">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $category->User->name }}</td>
                            <td>{{ $category->name }}</td>
                            @if ($category->status == 'Active')
                            <td><span class="badge badge-success">{{ $category->status }}</span></td>
                            @else
                            <td><span class="badge badge-danger">{{ $category->status }}</span></td>
                            @endif
                            <td style="min-width: 135px !important;">
                                <button title="Click to Update Category" class="btn btn-warning btn-sm editCatBtn" id="editCatBtn" data-catid="{{ $category->id }}"><i class="fe fe-pencil"></i> Edit</button>

                                <button title="Click to Delete Category" type="button" class="btn btn-danger btn-sm catDelete" id="catDelete" data-catid="{{ $category->id }}"><i class="fe fe-trash"></i> Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- END CARD --}}

    <!-- Modal For Adding Category-->
    <div class="modal fade" id="addCatModal" tabindex="-1" role="dialog" aria-labelledby="addCatModalArea" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCatModalArea" style="font-size: 18px !important;">Add New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/categories') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name*</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autocomplete="name" placeholder="Enter Category Name" />
                        </div>
                        <!-- Default switch -->
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="form-control custom-control-input" id="customSwitches" checked name="status" />
                            <label class="custom-control-label" for="customSwitches">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-md btn-danger" data-dismiss="modal"><i class="fas fa-backspace"></i> Cancel</button>
                        <button type="submit" class="btn btn-md btn-primary"><i class="fas fa-check-circle"></i> Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal For Editing Category-->
    <div class="modal fade editCatModal" id="editCatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelcatedit" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelcatedit" style="font-size: 18px !important;">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="requestCatData"></div>
            </div>
        </div>
    </div>

    <!-- Modal For Deleting Category-->
    <div class="modal fade deleteCatModal" id="deleteCatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelcatdelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelcatdelete" style="font-size: 18px !important;">Delete Confirmation !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure, you want to delete this Category?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">No, Cancel</button>
                    <button type="button" class="btn btn-md btn-primary deleteCatBtn" id="deleteCatBtn">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
