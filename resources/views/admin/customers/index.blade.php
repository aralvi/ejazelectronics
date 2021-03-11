@extends('layouts.admin') @section('title','Customers | ') @section('content-header','Cities') @section('content')
<!-- CONTAINER FLUID -->
<div class="container-fluid">
    <!-- ROW 1 -->
    <div class="row">
        <div class="col-md-6">
            <h2 style="margin-top: 4px;">List of Customers <small>({{ $total }})</small></h2>
        </div>
        <div class="col-md-6">
            <button title="Click to Add Customer" data-toggle="modal" data-target="#addCustomerModal" class="btn btn-primary btn-sm" style="float: right;"><i class="fas fa-plus"></i> Add Customers</button>
        </div>
    </div>
    <!-- END ROW 1 -->
    <br />

    <div class="card">
        <div class="card-body">
            <div class="table-responsive CustomerTableData" id="CustomerTableData">
                <table id="table-search" class="table table-hover">
                    <thead>
                        <tr class="text-uppercase">
                            <th scope="col">#</th>
                            <th scope="col">Customer</th>
                            <th scope="col">City</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            {{-- <th scope="col">Added by</th> --}}
                            <th>Status</th>
                            <th>Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $key => $customer)
                        @if ($customer->role == 'Permanent')

                        <tr id="target_{{ $customer->id }}">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->city }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->address }}</td>
                            {{-- <td>{{ $customer->User->name }}</td> --}}
                            <td>
                                @if ($customer->status == 'Active')
                                <span class="badge badge-success">{{ $customer->status }}</span>
                                @else
                                <span class="badge badge-danger">{{ $customer->status }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($customer->role == 'Permanent')
                                <span class="badge badge-success">{{ $customer->role }}</span>
                                @else
                                <span class="badge badge-danger">{{ $customer->role }}</span>
                                @endif
                            </td>
                            <td style="min-width: 135px !important;">
                                <button title="Click to Update Customer" class="btn btn-warning btn-sm editCustomerBtn" id="editCustomerBtn" data-Customerid="{{ $customer->id }}"><i class="fe fe-pencil"></i> Edit</button>
                                <button title="Click to View customer" type="button" class="btn btn-info btn-sm ProView" id="ProView" data-Proid="{{ $customer->id }}">
                                    <i class="fe fe-view"></i><a href="{{ url('admin/customers/'.$customer->id) }}" style="text-decoration: none; color: #fff;">More Info</a>
                                </button>
                                <button title="Click to Delete Customer" type="button" class="btn btn-danger btn-sm CustomerDelete" id="CustomerDelete" data-Customerid="{{ $customer->id }}"><i class="fe fe-trash"></i> Delete</button>
                            </td>
                        </tr>
                        @endif
                         @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- END CARD --}}

    <!-- Modal For Adding Customer-->
    <div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addCustomerModalArea" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCustomerModalArea" style="font-size: 18px !important;">Add New Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/customers') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name*</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autocomplete="name" placeholder="Enter Customer Name" />
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone*</label>
                            <input id="phone" type="tel" class="form-control" name="phone" value="{{ old('phone') }}" autocomplete="phone" placeholder="Enter Customer Phone" />
                        </div>
                        <div class="form-group">
                            <label for="City">City*</label>
                            <input id="City" type="text" class="form-control" name="city" value="{{ old('City') }}" autocomplete="City" placeholder="Enter Customer City" />
                        </div>
                        <div class="form-group">
                            <label for="address">Address*</label>
                            <textarea id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" autocomplete="address" placeholder="Enter Customer address" ></textarea>
                        </div>

                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="form-control custom-control-input" id="customSwitches" checked name="status" />
                            <label class="custom-control-label" for="customSwitches">Active</label>
                        </div>
                        {{-- <div class="custom-control custom-switch">
                            <input type="checkbox" class="form-control custom-control-input" id="customSwitches1" checked name="role" />
                            <label class="custom-control-label" for="customSwitches1">Permanent Customer</label>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-md btn-danger" data-dismiss="modal"><i class="fas fa-backspace"></i> Cancel</button>
                        <button type="submit" class="btn btn-md btn-primary"><i class="fas fa-check-circle"></i> Add Customer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal For Editing Customer-->
    <div class="modal fade editCustomerModal" id="editCustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelCustomerdit" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelCustomerdit" style="font-size: 18px !important;">Edit Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="requestCustomerData"></div>
            </div>
        </div>
    </div>

    <!-- Modal For Deleting Customer-->
    <div class="modal fade deleteCustomerModal" id="deleteCustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelCustomerdelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelCustomerdelete" style="font-size: 18px !important;">Delete Confirmation !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure, you want to delete this Customer?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">No, Cancel</button>
                    <button type="button" class="btn btn-md btn-primary deleteCustomerBtn" id="deleteCustomerBtn">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
