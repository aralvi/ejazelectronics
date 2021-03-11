<form action="{{ url('admin/products/'.$product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('put')
    <div class="modal-body">
        <div class="form-group">
            <label for="name">Name*</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ $product->name }}" autocomplete="name" placeholder="Enter Product Name" />
        </div>
        <div class="form-group">
            <label for="brand">Brand*</label>
            <select name="brand" id="brand" class="select2" data-live-search="true">
                <option value="" selected disabled>Select Brand</option>
                @foreach ($brands as $brand)
                <option value="{{ $brand->id }}" {{ ($brand->id == $product->brand_id) ? 'selected' : '' }}>{{ $brand->name }}</option>

                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="price">Price*</label>
                <input id="price" type="number" class="form-control" name="price" value="{{ $product->price }}" autocomplete="price" placeholder="Enter Product Price" />
            </div>

            <div class="form-group col-6">
                <label for="retail">Retail*</label>
                <input id="retail" type="number" class="form-control" name="retail" value="{{ $product->retail }}" autocomplete="retail" placeholder="Enter retail price" />
            </div>

            <div class="form-group col-6">
                <label for="productImage">Choose Product Image</label>
                <input type="file" name="image" class="form-control" style="border: none;" id="" />
            </div>
        </div>
        <div class="custom-control custom-switch">
            @if ($product->status == 'Active')
            <input type="checkbox" class="form-control custom-control-input" id="customSwitches1" checked name="status" />

            @else
            <input type="checkbox" class="form-control custom-control-input" id="customSwitches1" name="status" />

            @endif
            <label class="custom-control-label" for="customSwitches1">Active</label>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-md btn-danger" data-dismiss="modal"><i class="fas fa-backspace"></i> Cancel</button>
        <button type="submit" class="btn btn-md btn-primary"><i class="fas fa-check-circle"></i> Update Product</button>
    </div>
</form>
<script>
    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Initialize Select2 Elements
        $(".select2bs4").select2({
            theme: "bootstrap4",
        });
    });
</script>
