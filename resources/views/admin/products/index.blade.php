@extends('layouts.admin') @section('title','Products | ') @section('content')
<!-- CONTAINER FLUID -->
<div class="container-fluid">
    <!-- ROW 1 -->
    <div class="row">
        <div class="col-md-6">
            <h2 style="margin-top: 4px;">List of Products <small>({{ $total }})</small></h2>
        </div>
        <div class="col-md-6">
            <button title="Click to Add Product" data-toggle="modal" data-target="#addProModal" class="btn btn-primary btn-sm" style="float: right;"><i class="fas fa-plus"></i> Add Product</button>
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
                            <th>image</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Retail</th>
                            <th>Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key => $product) @if ($product->Brand->status != 'Inactive')

                        <tr id="target_{{ $product->id }}">
                            <td>{{ $key+1 }}</td>
                            <td>
                                @if ($product->image == null)
                                <img src="{{ asset('uploads/images/products/default.jpg') }}" class="img-circle" height="80" width="80" alt="" title="Product Image" />
                                @else
                                <img src="{{asset('uploads/images/products/'.$product->image)}}" class="img-circle" height="80" width="80" alt="" title="Product Image" />
                                @endif
                            </td>
                            <td>{{$product->name }}</td>
                            <td>{{$product->Brand->name }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->retail }}</td>
                            <td>
                                @if ($product->status == 'Active')
                                <span class="badge badge-success">{{ $product->status }}</span>
                                @else
                                <span class="badge badge-danger">{{ $product->status }}</span>
                                @endif
                            </td>
                            <td style="min-width: 135px !important;">
                                <button title="Click to Add Product Stock" class="btn btn-primary btn-sm addStockBtn" id="addStockBtn" data-Proid="{{ $product->id }}"><i class="fas fa-plus" style="font-weight: 600;"></i>Stock</button>
                                <button title="Click to Update Product" class="btn btn-warning btn-sm editProBtn" id="editProBtn" data-Proid="{{ $product->id }}" style="color: #fff;">Edit</button>
                                <button title="Click to View Product" type="button" class="btn btn-info btn-sm ProView" id="ProView" data-Proid="{{ $product->id }}">
                                    <i class="fe fe-view"></i><a href="{{ url('admin/products/'.$product->id) }}" style="text-decoration: none; color: #fff;">More Info</a>
                                </button>
                                <button title="Click to Delete Product" type="button" class="btn btn-danger btn-sm ProDelete" id="ProDelete" data-Proid="{{ $product->id }}"><i class="fe fe-trash"></i> Delete</button>
                            </td>
                        </tr>
                        @endif @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- END CARD --}}

    <!-- Modal For Adding Product-->
    <div class="modal fade" id="addProModal" tabindex="-1" role="dialog" aria-labelledby="addProModalArea" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProModalArea" style="font-size: 18px !important;">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/products') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name*</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autocomplete="name" placeholder="Enter Product Name" />
                        </div>
                        <div class="form-group">
                            <label for="brand">Brand*</label>
                            <select name="brand" id="brand" class="select2" data-live-search="true">
                                <option value="" selected disabled>Select Brand</option>
                                @foreach ($brands as $brand) @if ($brand->status !='Inactive')

                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endif @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="stock">Stock*</label>
                                <input id="stock" type="number" class="form-control" name="stock" value="{{ old('stock') }}" autocomplete="stock" placeholder="Enter Product Stock" />
                            </div>
                            <div class="form-group col-4">
                                <label for="price">Price*</label>
                                <input id="price" type="number" class="form-control" name="price" value="{{ old('price') }}" autocomplete="price" placeholder="Enter Product Price" />
                            </div>
                            <div class="form-group col-4">
                                <label for="price">Retail*</label>
                                <input id="retail" type="number" class="form-control" name="retail" value="{{ old('retail') }}" autocomplete="retail" placeholder="Enter Retail Price" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="productImage">Choose Product Image</label>
                            <input type="file" name="image" class="form-control" style="border: none;" id="" />
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="form-control custom-control-input" id="customSwitches" checked name="status" />
                            <label class="custom-control-label" for="customSwitches">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-md btn-danger" data-dismiss="modal"><i class="fas fa-backspace"></i> Cancel</button>
                        <button type="submit" class="btn btn-md btn-primary"><i class="fas fa-check-circle"></i> Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal For Adding Product-->
    <div class="modal fade" id="addStockModal" tabindex="-1" role="dialog" aria-labelledby="addStockModalArea" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStockModalArea" style="font-size: 18px !important;">Add New Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/stocks') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="stock">Stock*</label>
                            <input id="new_stock" type="number" class="form-control" name="new_stock" value="{{ old('stock') }}" autocomplete="stock" placeholder="Enter Stock" />
                            <input id="previous_stock" type="text" class="form-control product_id" name="product_id" value="{{ old('stock') }}" autocomplete="stock" placeholder="Enter Stock" style="display: none;" />
                        </div>
                        <div class="form-group">
                            <label for="date">Date*</label>
                            <input id="date" type="date" class="form-control" name="date" value="{{ old('date') }}" autocomplete="date" placeholder="Enter date" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-md btn-danger" data-dismiss="modal"><i class="fas fa-backspace"></i> Cancel</button>
                        <button type="submit" class="btn btn-md btn-primary addStock"><i class="fas fa-check-circle"></i> Add Stock</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal For Editing Product-->
    <div class="modal fade editProModal" id="editProModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelProedit" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelProedit" style="font-size: 18px !important;">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="requestProData"></div>
            </div>
        </div>
    </div>

    <!-- Modal For Deleting Product-->
    <div class="modal fade deleteProModal" id="deleteProModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelProdelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelProdelete" style="font-size: 18px !important;">Delete Confirmation !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure, you want to delete this Product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">No, Cancel</button>
                    <button type="button" class="btn btn-md btn-primary deleteProBtn" id="deleteProBtn">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
