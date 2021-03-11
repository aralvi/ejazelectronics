@extends('layouts.admin') @section('title','Product Info | ') @section('content')
<div class="row">
    <div class="col-6">
        <h1 class="font-italic">{{ $product->name }} <small class="badge badge-secondary">{{ $product->price }}Rs</small></h1>
        <p class="text-muted font-italic"> Product Actual Price :{{ $product->price }}</p>
        <p class="text-muted font-italic">{{ $product->Brand->name }} / {{ $product->Brand->Category->name }}</p>
        @if ($product->image == null)
        <img src="{{ asset('uploads/images/products/default.jpg') }}" alt="product-image" title="Product Image" style="width: 100%; height: 400px;" />
        @else
        <img src="{{asset('uploads/images/products/'.$product->image)}}" alt="product-image" title="Product Image" style="width: 100%; height: 400px;" />
        @endif
    </div>
    <div class="col-6">
        <div class="" style="display: flex;">
            <!-- small box -->

            <div class="small-box mr-2 col-4">
                <div class="inner">
                    <h3>{{ $product->stock +$product->sold }}</h3>
                    <p>Total Stock</p>
                </div>
                <div class="icon">
                    <i class="fas "></i>
                </div>
            </div>

            <div class="small-box mr-2 col-4">
                <div class="inner">
                    <h3>{{ $product->stock }}</h3>
                    <p>Available Stock</p>
                </div>
                <div class="icon">
                    <i class="fas fa-ballot"></i>
                </div>
            </div>
            <div class="small-box col-4">
                <div class="inner">
                    <h3>{{ ($product->sold)== ''?'0': $product->sold }}</h3>
                    <p>Sold Stock</p>
                </div>
                <div class="icon">
                    <i class="fas fa"></i>
                </div>
            </div>
        </div>

        <table id="table-search" class="table table-hover">
            <thead>
                <tr class="text-uppercase">
                    <th scope="col">#</th>
                    <th>Stock</th>
                    <th>Date</th>

                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $key => $stock) @if ($stock->product_id == $product->id)
                <tr id="target_{{ $stock->id }}">
                    <td>{{ $key+1 }}</td>
                    <td>{{$stock->new_stock }}</td>
                    <td>{{$stock->date }}</td>
                    <td style="min-width: 135px !important;">
                        <button title="Click to Update Stock" class="btn btn-warning btn-sm editStockBtn" id="editStockBtn" data-stockid="{{ $stock->id }}"><i class="fe fe-pencil"></i> Edit</button>
                        <button title="Click to Delete Stock" type="button" class="btn btn-danger btn-sm StockDelete" id="StockDelete" data-stockid="{{ $stock->id }}"><i class="fe fe-trash"></i> Delete</button>
                    </td>
                </tr>
                @endif @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal For Editing Product-->
<div class="modal fade editStockModal" id="editStockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelStockedit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelStockedit" style="font-size: 18px !important;">Edit Stockduct</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="requestStockData"></div>
        </div>
    </div>
</div>

<!-- Modal For Deleting Product-->
<div class="modal fade deleteStockModal" id="deleteStockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelStockdelete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelStockdelete" style="font-size: 18px !important;">Delete Confirmation !</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure, you want to delete this Stockduct?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">No, Cancel</button>
                <button type="button" class="btn btn-md btn-primary deleteStockBtn" id="deleteStockBtn">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>

@endsection @section('script')
<script>
    $(".editStockBtn").on("click", function () {
        $StockID = $(this).attr("data-stockid");
        $.ajax({
            type: "GET",
            url: "{{ url('admin/stocks') }}" + "/" + $StockID + "/edit",
            data: { _token: "{{ csrf_token() }}" },
            success: function (data) {
                $(".editStockModal").modal("toggle");
                $(".requestStockData").html(data);
            },
        });
    });

    $(".StockDelete").on("click", function () {
        $StockID = $(this).attr("data-Stockid");
        $("#deleteStockModal").modal("toggle");
        $("#deleteStockBtn").val($StockID);
    });

    $("#deleteStockBtn").on("click", function () {
        $StockID = $(this).val();
        alert("hi");
        $.ajax({
            type: "DELETE",
            url: '{{ url("admin/stocks") }}' + "/" + $StockID,
            data: { _token: "{{ csrf_token() }}" },
            success: function (data) {
                $("#deleteStockModal").modal("hide");
                $("#target_" + $StockID).hide();
            },
        });
    });
</script>
@endsection
