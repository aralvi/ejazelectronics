<form action="{{ url('admin/categories/'.$category->id) }}" method="POST">
    @csrf @method('put')
    <div class="modal-body">
        <div class="form-group">
            <label for="name">Name*</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ $category->name }}" autocomplete="name" placeholder="Enter Category Name" />
        </div>
        <div class="custom-control custom-switch">
            @if ($category->status == 'Active')
            <input type="checkbox" class="form-control custom-control-input" id="customSwitches1" checked name="status" />

            @else
            <input type="checkbox" class="form-control custom-control-input" id="customSwitches1" name="status" />

            @endif
            <label class="custom-control-label" for="customSwitches1">Active</label>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-md btn-danger" data-dismiss="modal"><i class="fas fa-backspace"></i> Cancel</button>
        <button type="submit" class="btn btn-md btn-primary"><i class="fas fa-check-circle"></i> Update Category</button>
    </div>
</form>
