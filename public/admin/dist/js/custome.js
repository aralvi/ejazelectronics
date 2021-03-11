// open edit categoory modal
$('.editCatBtn').on('click', function () {
    var catID = $(this).data('catid');
    $.ajax({
        type: 'get',
        url: url + '/admin/categories/' + catID + '/edit',
        success: function (data) {
            $('.requestCatData').html(data);
            $('.editCatModal').modal('toggle');
        }
    });
});

/*** Open Deleting Category  Modal ***/
$('.catDelete').on('click', function () {
    var catID = $(this).data('catid');

    $('#deleteCatModal').modal('toggle');
    $('#deleteCatBtn').val(catID);
});

/*** Deleting Category  ***/
$('#deleteCatBtn').on('click', function () {
    var catID = $(this).val();
    $.ajax({
        type: 'post',
        url: url + '/admin/categories/' + catID,
        data: { id: catID, _token: token, _method: 'DELETE' },
        success: function (data) {
            $("#deleteCatModal").modal("hide");
            $("#target_" + catID).hide();
            $('#success_errror_any').addClass("hide");
            $('#messageDiv').removeClass("alert-danger hide");
            $('#messageDiv').addClass("alert-success");
            $('#message').html(data);
        }, error: function () {
            $('#success_errror_any').addClass("hide");
            $('#messageDiv').removeClass("alert-success hide");
            $('#messageDiv').addClass("alert-danger");
            $('#message').html('Category not found or Something is wrong');
            $('#deleteCatModal').modal('hide');
        }

    });
});

// end of Category section

// open edit Brand modal
$('.editBrandBtn').on('click', function () {
    var brandID = $(this).data('brandid');
    $.ajax({
        type: 'get',
        url: url + '/admin/brands/' + brandID + '/edit',
        success: function (data) {
            $('.requestBrandData').html(data);
            $('.editBrandModal').modal('toggle');
        }
    });
});

/*** Open Deleting Brand  Modal ***/
$('.BrandDelete').on('click', function () {
    var brandID = $(this).data('brandid');

    $(".deleteBrandModal").modal("toggle");
    $(".deleteBrandBtn").val(brandID);
});

/*** Deleting Brand  ***/
$('.deleteBrandBtn').on('click', function () {
    var brandID = $(this).val();
    $.ajax({
        type: 'post',
        url: url + '/admin/brands/' + brandID,
        data: { id: brandID, _token: token, _method: 'DELETE' },
        success: function (data) {
            $(".deleteBrandModal").modal("hide");
            $("#target_" + brandID).hide();
        },

    });
});
// end of Brands section

// open edit Brand modal
$('.editCustomerBtn').on('click', function () {
    var customerid = $(this).attr('data-Customerid');
    $.ajax({
        type: 'get',
        url: url + '/admin/customers/' + customerid + '/edit',
        success: function (data) {
            $('.requestCustomerData').html(data);
            $('.editCustomerModal').modal('toggle');
        }
    });
});

/*** Open Deleting Brand  Modal ***/
$('.CustomerDelete').on('click', function () {
    var customerid = $(this).attr('data-Customerid');

    $(".deleteCustomerModal").modal("toggle");
    $(".deleteCustomerBtn").val(customerid);
});

/*** Deleting Brand  ***/
$('.deleteCustomerBtn').on('click', function () {
    var customerid = $(this).val();
    $.ajax({
        type: 'post',
        url: url + '/admin/customers/' + customerid,
        data: { id: customerid, _token: token, _method: 'DELETE' },
        success: function (data) {
            $(".deleteCustomerModal").modal("hide");
            $("#target_" + customerid).hide();
        },

    });
});
// end of Brands section


// Open Edit Product modal
$('.editProBtn').on('click', function () {
    var ProID = $(this).attr("data-Proid");
    $.ajax({
        type: 'get',
        url: url + '/admin/products/' + ProID + '/edit',
        success: function (data) {
            $(".editProModal").modal("toggle");
            $(".requestProData").html(data);
        }
    });
});


/*** Open Deleting Product Group Modal ***/
$('.ProDelete').on('click', function () {
    var ProID = $(this).attr("data-Proid");

    $("#deleteProModal").modal("toggle");
    $("#deleteProBtn").val(ProID);
});

/*** Deleting Product Group ***/
$('#deleteProBtn').on('click', function () {
    var ProID = $(this).val();
    $.ajax({
        type: 'post',
        url: url + '/admin/products/' + ProID,
        data: { id: ProID, _token: token, _method: 'DELETE' },
        success: function (data) {
            $("#deleteProModal").modal("hide");
            $("#target_" + ProID).hide();
        },

    });
});

// open ad stock modal
$(".addStockBtn").on("click", function () {
    $ProID = $(this).attr("data-Proid");
    $("#addStockModal").modal("toggle");
    $(".product_id").val($ProID);
});


$(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Initialize Select2 Elements
    $(".select2bs4").select2({
        theme: "bootstrap4",
    });
});

// end of products section


// Open Edit user modal
$('.editUserBtn').on('click', function () {
    var UserID = $(this).data('userid');
    $.ajax({
        type: 'get',
        url: url + '/admin/users/' + UserID + '/edit',
        success: function (data) {
            $(".editUserModal").modal("toggle");
            $(".requestUserData").html(data);
        }
    });
});


/*** Open Deleting User Group Modal ***/
$('.UserDelete').on('click', function () {
    var UserID = $(this).data('userid');
    $("#deleteUserModal").modal("toggle");
    $("#deleteUserBtn").val(UserID);
});


/*** Deleting User Group ***/
$('#deleteUserBtn').on('click', function () {
    var UserID = $(this).val();
    $.ajax({
        type: 'post',
        url: url + '/admin/users/' + UserID,
        data: { id: UserID, _token: token, _method: 'DELETE' },
        success: function (data) {
            $("#deleteUserModal").modal("hide");
            $("#target_" + UserID).hide();
        },

    });
});




// end of user section

