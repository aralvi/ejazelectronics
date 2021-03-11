<form action="{{ url('admin/brands/'.$brand->id) }}" method="POST">
    @csrf @method('put')
    <div class="modal-body">
        <div class="form-group">
            <label for="name">Name*</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ $brand->name }}" autocomplete="name" placeholder="Enter Brandegory Name" />
        </div>
        <div class="form-group">
            <label for="category">Category*</label>
            <select name="category" id="category" class="select2" data-live-search="true">
                <option value="" selected disabled>Select Category</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ ($category->id) == $brand->category_id ? 'selected': '' }}>{{ $category->name }}</option>

                @endforeach
            </select>
        </div>
        <div class="custom-control custom-switch">
            @if ($brand->status == 'Active')
            <input type="checkbox" class="form-control custom-control-input" id="customSwitches1" checked name="status" />

            @else
            <input type="checkbox" class="form-control custom-control-input" id="customSwitches1" name="status" />

            @endif
            <label class="custom-control-label" for="customSwitches1">Active</label>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-md btn-danger" data-dismiss="modal"><i class="fas fa-backspace"></i> Cancel</button>
        <button type="submit" class="btn btn-md btn-primary"><i class="fas fa-check-circle"></i> Update Brand</button>
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
