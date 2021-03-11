<form action="{{ url('admin/customers/'.$customer->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name*</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $customer->name }}" autocomplete="name" placeholder="Enter Customer Name" />
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone*</label>
                            <input id="phone" type="tel" class="form-control" name="phone" value="{{ $customer->phone }}" autocomplete="phone" placeholder="Enter Customer Phone" />
                        </div>
                        <div class="form-group">
                            <label for="City">City*</label>
                            <input id="City" type="text" class="form-control" name="city" value="{{ $customer->city }}" autocomplete="City" placeholder="Enter Customer City" />
                        </div>
                        <div class="form-group">
                            <label for="address">Address*</label>
                            <textarea id="address" type="text" class="form-control" name="address" autocomplete="address" placeholder="Enter Customer address" >{{ $customer->address }}</textarea>
                        </div>

                        <div class="custom-control custom-switch">
                             @if ($customer->status == 'Active')
                                <input type="checkbox" class="form-control custom-control-input" id="customSwitches2" checked name="status" />

                                @else
                                <input type="checkbox" class="form-control custom-control-input" id="customSwitches2" name="status" />

                                @endif
                            <label class="custom-control-label" for="customSwitches2">Active</label>
                        </div>
                        {{-- <div class="custom-control custom-switch">
                             @if ($customer->role == 'Permanent')
                                <input type="checkbox" class="form-control custom-control-input" id="customSwitches3" checked name="role" />

                                @else
                                <input type="checkbox" class="form-control custom-control-input" id="customSwitches3" name="role" />

                                @endif
                            <label class="custom-control-label" for="customSwitches3">Permanent</label>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-md btn-danger" data-dismiss="modal"><i class="fas fa-backspace"></i> Cancel</button>
                        <button type="submit" class="btn btn-md btn-primary"><i class="fas fa-check-circle"></i> Update Customer</button>
                    </div>
                </form>
