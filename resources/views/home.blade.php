@extends('layouts.app') @section('content')
<div class="container">
    {{--
    <div class="row justify-content-center">
        --}}
        <div class="">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item permanent" role="presentation">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Permanent Customer</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Local Customer</a>
                        </li>

                    </ul>
                </div>
                <div id="success_errror_any">
                    @if (session('success'))
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-success alert-block" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ session('success') }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif @if (session('error'))
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger alert-block" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ session('error') }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif @if ($errors->any())
                    <div class="container-fluid">
                        <div class="alert alert-danger alert-block" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="row">
                        <!-- column -->
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-block">
                                    <div class="invoice-form">
                                        <form action="{{url('/generateInvoice')}}" method="post" target="_blank" id="invoice_form">
                                            @csrf
                                            <div class="row">

                                                <div class="tab-content col-lg-12" id="pills-tabContent">

                                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                                        <div class="form-group m-2 ">
                                                            <label for="name" class="font-weight-bold">Customer Name</label>
                                                            <select name="customer" class="form-control select2" id="" >
                                                                <option value="" selected disabled>Choose Customer</option>
                                                                @foreach ($clients as $client)
                                                                @if ($client->role == 'Permanent')

                                                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                            <div class="row">
                                                                <div class="form-group m-2 col-5">
                                                                    <label for="name" class="font-weight-bold">Customer Name</label>
                                                                    <input type="text" name="client_name" id="client_name" class="form-control " aria-label="Large"  placeholder="Enter Customer Name" />
                                                                    <div id="clientList"></div>
                                                                </div>
                                                                <div class="form-group m-2 col-5">
                                                                    <label for="phone" class="font-weight-bold">Customer Phone number</label>
                                                                    <input type="tel" class="form-control input-lg" name="phone" aria-label="Large"  placeholder="Enter Customer Phone number" id="" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered my-4">
                                                    {{-- table headings started --}}
                                                    <thead class="">
                                                        <tr class="text-uppercase">
                                                            <th scope="col">Items</th>
                                                            <th scope="col">Price</th>
                                                            <th scope="col">Quantity</th>
                                                            <th scope="col">Total Price</th>
                                                            <th scope="col">Product Discount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="t_body">
                                                        <tr class="last productRow">
                                                            <td>
                                                                <select name="products[]" class="form-control product last select2" data-live-search="true" id="products" required>
                                                                    <option value="" disabled selected>Choose Product</option>
                                                                    @foreach ($products as $key => $product)
                                                                    @if ($product->stock == '0')

                                                                    <option value="{{$product->id}}" data-price="{{ $product->retail }}" data-actual_price="{{ $product->price }}" disabled>{{ $product->name }} "stock unavailable"</option>
                                                                    @else

                                                                    <option value="{{$product->id}}" data-price="{{ $product->retail }}" data-actual_price="{{ $product->price }}" >{{ $product->name }}</option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                                <label for="" id="lblproduct" style="display: none;"></label>
                                                            </td>
                                                            <td class="tdprice">
                                                                <input type="number" class="form-control price" name="price[]" min="0" readonly/>
                                                            </td>
                                                            <td class="tdquantity">
                                                                <input type="number" class="form-control quantity last" name="quantity[]" min="0" readonly />
                                                            </td>
                                                            <td class="tdtotalPrice">
                                                                <input type="number" class="form-control totalPrice" id="totalPrice" name="totalPrice[]" min="0" readonly />
                                                            </td>
                                                            <td class="proDiscount">
                                                                <input type="number" class="form-control proDiscount " id="proDiscount" name="proDiscount[]" min="0" value="0" readonly />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col ml-3">
                                                    <label for="Grand Total">Grand Total</label>
                                                    <input type="number" class="form-control grandTotal" name="grandTotal" readonly />
                                                </div>
                                                <div class="form-group col ml-3">
                                                    <label for="paid">Paid Amount</label>
                                                    <input type="number" class="form-control paidAmount" name="netAmount" />
                                                    <label for="" id="paidAmoutn"></label>
                                                </div>
                                                <div class="form-group col ml-3">
                                                    <label for="return">Return Amount</label>
                                                    <input type="number" class="form-control returnAmount" name="returnAmount" readonly />
                                                </div>
                                                <div class="form-group col ml-3">
                                                    <label for="total_discount">Total Discount</label>
                                                    <input type="number" class="form-control total_discount" name="total_discount" value="0" readonly />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" name="submit" class="btn btn-success" id="submit" value="Submit" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--
    </div>
    --}}
</div>
@endsection @section('script')

<script>
    $(document).ready(function () {
        $(document).on("change", "select.last", function () {
            $("tr.productRow").each(function () {
                $(this).removeClass("last");
                $(this).addClass("first");
            });
            $("select.product").each(function () {
                $(this).removeClass("last");
                $(this).addClass("first");
            });
            $("input.last").each(function () {
                $(this).attr("required", "required");
                $(this).removeClass("last");
                $(this).removeAttr("readonly");
                $(this).addClass("first");
                $(this).val(1);
            });
            $("input.proDiscount").each(function () {
                $(this).attr("required", "required");
                $(this).removeClass("last");
                $(this).removeAttr("readonly");
                $(this).addClass("first");
            });

            var selectedProduct = $(this).children("option:selected");
            var selectedProductPrice = $(this).children("option:selected").attr("data-price");
            var Quantity = $(this).parent("td").siblings("td").children("input.quantity").val();

            $(this).parent("td").next("td").children("input.price").val(selectedProductPrice);
            $(this)
                .parent("td")
                .siblings("td")
                .children("input.totalPrice")
                .val(selectedProductPrice * Quantity);

            $("#t_body").append(
                '<tr class="last productRow"> <td> <select name="products[]" class="form-control product last select2" data-live-search="true"  id="products"> <option value="" disabled selected>Choose Product</option> @foreach ($products as $key => $product) <option value="{{$product->id}}" data-price="{{ $product->retail }}">{{ $product->name }}</option> @endforeach </select> </td> <td class="tdprice"> <input type="number" class="form-control price" name="price[]" min="0" readonly > </td> <td class="tdquantity"> <input type="number" class="form-control quantity last" name="quantity[]" min="0" readonly> </td> <td class="tdtotalPrice"> <input type="number" class="form-control totalPrice" id="totalPrice" name="totalPrice[]" min="0" readonly > </td><td class="proDiscount"><input type="number" class="form-control proDiscount" id="proDiscount" name="proDiscount[]" min="0" value="0" readonly /></td> </tr>'
            );
            $(".select2").select2();
            calculateTotal();
        });

        $(document.body).on("change", "select.first", function () {
            $(this).parent("td").siblings("td").children("input.quantity").val(1);
            var selectedProduct = $(this).children("option:selected");
            var selectedProductPrice = $(this).children("option:selected").attr("data-price");
            var Quantity = $(this).parent("td").siblings("td").children("input.quantity").val();

            $(this).parent("td").next("td").children("input.price").val(selectedProductPrice);

            $(this)
                .parent("td")
                .siblings("td")
                .children("input.totalPrice")
                .val(selectedProductPrice * Quantity);
            calculateTotal();
            calculateDiscount();
        });

        $(document.body).on("change", "input.quantity", function () {
            var ProductPrice = $(this).parent("td").siblings("td").children("input.price").val();
            var quantity = $(this).val();
            $(this)
                .parent("td")
                .siblings("td")
                .children("input.totalPrice")
                .val(ProductPrice * quantity);
            calculateTotal();
            calculateDiscount();

        });
        $(document.body).on("change", "input.proDiscount", function () {

         $discount = $(this) .val();
            $(this)
                .parent("td")
                .siblings("td")
                .children("input.totalPrice")
                .val(calculateDiscount());


        });


        function calculateTotal() {
            let inputs = document.querySelectorAll("td > .totalPrice");

            let sum = 0;
            for (let input of inputs) {
                sum += +input.value;
            }

            let grandTotal = document.querySelector(".grandTotal");

            // console.log(sum);
            grandTotal.value = sum;
            calculteReturn();
        }
        function calculateDiscount() {
            let inputs = document.querySelectorAll("td > .proDiscount");

            let sum = 0;
            for (let input of inputs) {
                sum += +input.value;
            }

            let total_discount = document.querySelector(".total_discount");

            // console.log(sum);
            total_discount.value = sum;
            calculateDiscount();
        }

        $(".paidAmount").on("change", function () {
            $netAmount = $(this).val();
            $grandTotal = $(".grandTotal").val();
            $total_discount = $(".total_discount").val();
            $(".returnAmount").val($netAmount - ($grandTotal - $total_discount));
        });

        $("#submit").on("click", function () {
            if($('.grandTotal').val() == ''){
                $("#lblproduct").html("Choose atleast one product!").css({ display: "block", color: "red" });
                return false;
            }else{
                $("#lblproduct").css("display", "none");
            }
            if ($(".paidAmount").val() == "") {
                $("#paidAmoutn").html("this field is required!").css({ display: "block", color: "red" });
                return false;

            } else {
                $("#paidAmoutn").css("display", "none");
            }
            $("tr.last").remove();
            $('#invoice_form').reset();
        });

    });

    $(document).ready(function () {
        $("#client_name").keyup(function () {
            var query = $(this).val();
            if (query != "") {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('autocomplete.fetch') }}",
                    method: "POST",
                    data: { query: query, _token: _token },
                    success: function (data) {
                        $("#clientList").fadeIn();
                        $("#clientList").html(data);
                    },
                });
            }
        });

        $(document).on("click", "#clientList>li", function () {
            $("#client_name").val($(this).text());
            $("#clientList").fadeOut();
        });
    });
</script>
@endsection
