@extends('layouts.admin') @section('title','users | ') @section('content')
<!-- CONTAINER FLUID -->
<div class="container-fluid">
    <!-- ROW 1 -->
    <div class="row">
        <div class="col-md-6">
            <h2 style="margin-top: 4px;">List of Users <small>({{ $total }})</small></h2>
        </div>
        <div class="col-md-6">
            <button title="Click to Add user" data-toggle="modal" data-target="#addUserModal" class="btn btn-primary btn-sm" style="float: right;"><i class="fas fa-plus"></i> Add user</button>
        </div>
    </div>
    <!-- END ROW 1 -->
    <br />

    <div class="card">
        <div class="card-body">
            <div class="table-responsive UserTableData" id="UserTableData">
                <table id="table-search" class="table table-hover">
                    <thead>
                        <tr class="text-uppercase">
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $key => $user)
                        <tr id="target_{{ $user->id }}">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            @if ($user->role == 'Admin')
                            <td><span class="badge badge-success">{{ $user->role }}</span></td>
                            @else
                            <td><span class="badge badge-danger">{{ $user->role }}</span></td>
                            @endif @if ($user->status == 'Active')
                            <td><span class="badge badge-success">{{ $user->status }}</span></td>
                            @else
                            <td><span class="badge badge-danger">{{ $user->status }}</span></td>
                            @endif
                            <td style="min-width: 135px !important;">
                                @if (Auth::user()->id == $user->id)

                                <button title="Click to Update user" class="btn btn-warning btn-sm editUserBtn" id="editUserBtn" data-Userid="{{ $user->id }}"disabled ><i class="fe fe-pencil"></i> Edit</button>

                                <button title="Click to Delete user" type="button" class="btn btn-danger btn-sm UserDelete" id="UserDelete" data-Userid="{{ $user->id }}" disabled><i class="fe fe-trash"></i> Delete</button>
                                @else
                                <button title="Click to Update user" class="btn btn-warning btn-sm editUserBtn" id="editUserBtn" data-Userid="{{ $user->id }}"><i class="fe fe-pencil"></i> Edit</button>

                                <button title="Click to Delete user" type="button" class="btn btn-danger btn-sm UserDelete" id="UserDelete" data-Userid="{{ $user->id }}"><i class="fe fe-trash"></i> Delete</button>

                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- END CARD --}}

    <!-- Modal For Adding user-->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalArea" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalArea" style="font-size: 18px !important;">Add New user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/users') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name*</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autocomplete="name" placeholder="Enter Name" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email*</label>
                            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Enter email" />
                        </div>
                        <div class="form-group">
                            <label for="password">Password*</label>
                            <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" autocomplete="password" placeholder="Enter password" />
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password*</label>
                            <input
                                id="password_confirmation"
                                type="password"
                                class="form-control"
                                name="password_confirmation"
                                value="{{ old('password_confirmation') }}"
                                autocomplete="password_confirmation"
                                placeholder="Re-enter password"
                            />
                        </div>
                        <!-- Default switch -->

                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="form-control custom-control-input" id="customSwitches" checked name="status" />
                            <label class="custom-control-label" for="customSwitches">Active</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="form-control custom-control-input" id="customSwitches1" name="role" />
                            <label class="custom-control-label" for="customSwitches1">Admin</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-md btn-danger" data-dismiss="modal"><i class="fas fa-backspace"></i> Cancel</button>
                        <button type="submit" class="btn btn-md btn-primary"><i class="fas fa-check-circle"></i> Add user</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal For Editing user-->
    <div class="modal fade editUserModal" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelUseredit" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelUseredit" style="font-size: 18px !important;">Edit user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="requestUserData"></div>
            </div>
        </div>
    </div>

    <!-- Modal For Deleting user-->
    <div class="modal fade deleteUserModal" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelUserdelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelUserdelete" style="font-size: 18px !important;">Delete Confirmation !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure, you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">No, Cancel</button>
                    <button type="button" class="btn btn-md btn-primary deleteUserBtn" id="deleteUserBtn">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection @section('script')
<script>

    // $(".UserDelete").on("click", function () {
    //     $UserID = $(this).attr("data-Userid");
    //     $("#deleteUserModal").modal("toggle");
    //     $("#deleteUserBtn").val($UserID);
    // });

    // $("#deleteUserBtn").on("click", function () {
    //     $UserID = $(this).val();
    //     $.ajax({
    //         type: "DELETE",
    //         url: '{{ url("admin/users") }}' + "/" + $UserID,
    //         data: { _token: "{{ csrf_token() }}" },
    //         success: function (data) {
    //             $("#deleteUserModal").modal("hide");
    //             $("#target_" + $UserID).hide();
    //         },
    //     });
    // });
</script>
@endsection
