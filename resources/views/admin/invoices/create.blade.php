@extends('layouts/admin') @section('title','Inventory-System | Invoices') @section('style')
<style>
    #delete-cmnt-modal {
        border-radius: 30px;
    }
    thead {
        /* background-color: black; */
        color: #000;
        background-image: linear-gradient(100deg, deeppink, #0000ff61);
    }
</style>

@endsection @section('content')

<!-- Container fluid  -->

<div class="container-fluid">
    <!-- Bread crumb and right sidebar toggle -->

    <!-- End Bread crumb and right sidebar toggle -->

    <!-- Start Page Content -->

    <div class="row">
        <!-- column -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-block">
                    <div class="invoice-form">
                        <form action="{{url('admin/invoices')}}" method="post">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered my-4">
                                    {{-- table headings started --}}
                                    <thead class="">
                                        <tr class="text-uppercase">
                                            <th scope="col">Items</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody id="t_body">
                                        <tr class="last productRow">
                                            <td>
                                                <select name="products[]" class="form-control product last select2" data-live-search="true" id="products">
                                                    <option value="" disabled selected>Choose Product</option>
                                                    @foreach ($products as $key => $product)
                                                    <option value="{{$product->id}}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="tdprice">
                                                <input type="number" class="form-control price" name="price[]" min="0" readonly />
                                            </td>
                                            <td class="tdquantity">
                                                <input type="number" class="form-control quantity last" name="quantity[]" min="0" readonly />
                                            </td>
                                            <td class="tdtotalPrice">
                                                <input type="number" class="form-control totalPrice" id="totalPrice" name="totalPrice[]" min="0" readonly />
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

<!-- End Container fluid  -->

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
                '<tr class="last productRow"> <td> <select name="products[]" class="form-control product last select2" data-live-search="true"  id="products"> <option value="" disabled selected>Choose Product</option> @foreach ($products as $key => $product) <option value="{{$product->id}}" data-price="{{ $product->price }}">{{ $product->name }}</option> @endforeach </select> </td> <td class="tdprice"> <input type="number" class="form-control price" name="price[]" min="0" readonly > </td> <td class="tdquantity"> <input type="number" class="form-control quantity last" name="quantity[]" min="0" readonly> </td> <td class="tdtotalPrice"> <input type="number" class="form-control totalPrice" id="totalPrice" name="totalPrice[]" min="0" readonly > </td> </tr>'
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

        $(".paidAmount").on("change", function () {
            $netAmount = $(this).val();
            $grandTotal = $(".grandTotal").val();
            $(".returnAmount").val($netAmount - $grandTotal);
        });

        $("#submit").on("click", function () {
            $("tr.last").remove();

            if ($(".paidAmount").val() == "") {
                $("#paidAmoutn").html("this field is required!").css({ display: "block", color: "red" });
                return false;
            } else if ($(".paidAmount").val() < $(".grandTotal").val()) {
                $("#paidAmoutn").html("your total payable is !").css({ display: "block", color: "red" });
                return false;
            } else {
                $("#paidAmoutn").css("display", "none");
            }
        });
    });
</script>
@endsection
