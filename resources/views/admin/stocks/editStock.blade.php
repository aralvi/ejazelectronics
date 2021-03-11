<form action="{{ url('admin/stocks/'.$stock->id) }}" method="POST">
    @csrf @method('put')
    <div class="modal-body">
        <div class="form-group">
            <label for="stock">Stock*</label>
            <input id="stock" type="number" class="form-control" name="new_stock" value="{{$stock->new_stock}}" autocomplete="stock" placeholder="Enter Stock" />
            <input id="stock" type="text" class="form-control product_id" name="product_id" value="{{ $stock->product_id }}" autocomplete="stock" placeholder="Enter Stock" style="display: none;" />
        </div>
        <div class="form-group">
            <label for="date">Date*</label>
            <input id="date" type="date" class="form-control" name="date" value="{{$stock->date }}" autocomplete="date" placeholder="Enter date" />
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-md btn-danger" data-dismiss="modal"><i class="fas fa-backspace"></i> Cancel</button>
        <button type="submit" class="btn btn-md btn-primary addStock"><i class="fas fa-check-circle"></i> Update Stock</button>
    </div>
</form>
