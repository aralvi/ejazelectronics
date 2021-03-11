<form action="{{ url('admin/users/'.$user->id) }}" method="POST">
    @csrf @method('put')
    <div class="modal-body">
        <div class="form-group">
            <label for="name">Name*</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" autocomplete="name" placeholder="Enter Name" />
        </div>
        <div class="form-group">
            <label for="email">Email*</label>
            <input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}" autocomplete="email" readonly placeholder="Enter email" />
        </div>
        <div class="form-group d-none">
            <label for="password">Password*</label>
            <input id="password" type="password" class="form-control" name="password" value="{{ $user->password }}" autocomplete="password" placeholder="Enter password" />
        </div>
        <!-- Default switch -->

        <div class="custom-control custom-switch">
            @if ($user->status == 'Active')

            <input type="checkbox" class="form-control custom-control-input" id="customSwitches2" checked name="status" />
            @else
            <input type="checkbox" class="form-control custom-control-input" id="customSwitches2" name="status" />

            @endif
            <label class="custom-control-label" for="customSwitches2">Active</label>
        </div>
        <div class="custom-control custom-switch">
            @if ($user->role == 'Admin')
            <input type="checkbox" class="form-control custom-control-input" id="customSwitches3" checked name="role" />
            @else
            <input type="checkbox" class="form-control custom-control-input" id="customSwitches3" name="role" />

            @endif
            <label class="custom-control-label" for="customSwitches3">Admin</label>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-md btn-danger" data-dismiss="modal"><i class="fas fa-backspace"></i> Cancel</button>
        <button type="submit" class="btn btn-md btn-primary"><i class="fas fa-check-circle"></i> Update user</button>
    </div>
</form>
