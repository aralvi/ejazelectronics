@extends('layouts.admin') @section('title','Invoices | ') @section('content')
<!-- CONTAINER FLUID -->
<div class="container-fluid">
    <!-- ROW 1 -->
    <div class="row">
        <div class="col-md-6">
            <h2 style="margin-top: 4px;">List of Invoices <small>({{ $total }})</small></h2>
        </div>
    </div>
    <!-- END ROW 1 -->
    <br />

    <div class="card">
        <div class="card-body">
            <div class="table-responsive InvoiceTableData" id="InvoiceTableData">
                <table id="table-search" class="table table-hover">
                    <thead>
                        <tr class="text-uppercase">
                            <th scope="col">#</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Products</th>
                            <th scope="col">total Price</th>
                            <th scope="col">total Discount</th>
                            <th scope="col">paid</th>
                            <th scope="col">returned</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $key => $invoice)
                        <tr id="target_{{ $invoice->id }}">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $invoice->Client->name }}</td>
                            <td>{{ $invoice->total_products }}</td>
                            <td>{{ $invoice->total_price }}</td>
                            <td>{{ $invoice->total_discount }}</td>
                            <td>{{ $invoice->net_amount }}</td>
                            <td>{{ $invoice->return_amount }}</td>

                            <td style="min-width: 135px !important;">
                                <button title="Click to View Invoice" type="button" class="btn btn-info btn-sm InvoiceView" id="ProView" data-Invoiceid="{{ $invoice->id }}">
                                    <i class="fe fe-trash"></i><a href="{{ url('admin/invoices/'.$invoice->id) }}" style="text-decoration: none; color: #fff;">More Info</a>
                                </button>
                                <button title="Click to Delete invoice" type="button" class="btn btn-danger btn-sm InvoiceDelete" id="InvoiceDelete" data-Invoiceid="{{ $invoice->id }}"><i class="fe fe-trash"></i> Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- END CARD --}}

    <!-- Modal For Deleting invoice-->
    <div class="modal fade deleteInvoiceModal" id="deleteInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelInvoicedelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelInvoicedelete" style="font-size: 18px !important;">Delete Confirmation !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure, you want to delete this invoice?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">No, Cancel</button>
                    <button type="button" class="btn btn-md btn-primary deleteInvoiceBtn" id="deleteInvoiceBtn">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection @section('script')
<script>
    $(".InvoiceDelete").on("click", function () {
        $InvoiceID = $(this).attr("data-Invoiceid");
        $("#deleteInvoiceModal").modal("toggle");
        $("#deleteInvoiceBtn").val($InvoiceID);
    });

    $("#deleteInvoiceBtn").on("click", function () {
        $InvoiceID = $(this).val();
        $.ajax({
            type: "DELETE",
            url: '{{ url("admin/invoices") }}' + "/" + $InvoiceID,
            data: { _token: "{{ csrf_token() }}" },
            success: function (data) {
                $("#deleteInvoiceModal").modal("hide");
                $("#target_" + $InvoiceID).hide();
            },
        });
    });
</script>
@endsection
