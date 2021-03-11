@extends('layouts.admin') @section('title','Brands | ') @section('content-header','Cities') @section('content')
<!-- CONTAINER FLUID -->
<div class="container-fluid">
    <!-- ROW 1 -->
    <div class="row">
        <div class="col-md-6">
            <h2 style="margin-top: 4px;">List of Brands <small>({{ $total }})</small></h2>
        </div>
        <div class="col-md-6">
            <button title="Click to Add Brand" data-toggle="modal" data-target="#addBrandModal" class="btn btn-primary btn-sm" style="float: right;"><i class="fas fa-plus"></i> Add Brands</button>
        </div>
    </div>
    <!-- END ROW 1 -->
    <br />

    <div class="card">
        <div class="card-body">
            <div class="table-responsive BrandTableData" id="BrandTableData">
                <table id="table-search" class="table table-hover">
                    <thead>
                        <tr class="text-uppercase">
                            <th scope="col">#</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Added by</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $key => $brand) @if ($brand->Category->status != 'Inactive')

                        <tr id="target_{{ $brand->id }}">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->User->name }}</td>
                            <td>{{ $brand->Category->name }}</td>
                            <td>
                                @if ($brand->status == 'Active')
                                <span class="badge badge-success">{{ $brand->status }}</span>
                                @else
                                <span class="badge badge-danger">{{ $brand->status }}</span>
                                @endif
                            </td>
                            <td style="min-width: 135px !important;">
                                <button title="Click to Update Brand" class="btn btn-warning btn-sm editBrandBtn" id="editBrandBtn" data-Brandid="{{ $brand->id }}"><i class="fe fe-pencil"></i> Edit</button>

                                <button title="Click to Delete Brand" type="button" class="btn btn-danger btn-sm BrandDelete" id="BrandDelete" data-Brandid="{{ $brand->id }}"><i class="fe fe-trash"></i> Delete</button>
                            </td>
                        </tr>
                        @endif @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- END CARD --}}

    <!-- Modal For Adding Brandegory-->
    <div class="modal fade" id="addBrandModal" tabindex="-1" role="dialog" aria-labelledby="addBrandModalArea" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBrandModalArea" style="font-size: 18px !important;">Add New Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/brands') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name*</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autocomplete="name" placeholder="Enter Brandegory Name" />
                        </div>
                        <div class="form-group">
                            <label for="category">Category*</label>
                            <select name="category" id="category" class="select2 form-control" data-live-search="true">
                                <option value="" selected disabled>Select Category</option>
                                @foreach ($categories as $category) @if ($category->status != 'Inactive')

                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif @endforeach
                            </select>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="form-control custom-control-input" id="customSwitches" checked name="status" />
                            <label class="custom-control-label" for="customSwitches">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-md btn-danger" data-dismiss="modal"><i class="fas fa-backspace"></i> Cancel</button>
                        <button type="submit" class="btn btn-md btn-primary"><i class="fas fa-check-circle"></i> Add Brand</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal For Editing Brandegory-->
    <div class="modal fade editBrandModal" id="editBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelBrandedit" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelBrandedit" style="font-size: 18px !important;">Edit Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="requestBrandData"></div>
            </div>
        </div>
    </div>

    <!-- Modal For Deleting Brandegory-->
    <div class="modal fade deleteBrandModal" id="deleteBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelBranddelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelBranddelete" style="font-size: 18px !important;">Delete Confirmation !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure, you want to delete this Brand?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">No, Cancel</button>
                    <button type="button" class="btn btn-md btn-primary deleteBrandBtn" id="deleteBrandBtn">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
